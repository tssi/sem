<?php
class Record extends AppModel {
	var $name = 'Record';
	var $useTable = false;
	var $baseDir ="";
	//".."..'.DS.'..'.DS.'ser'.DS.'api'.DS.'records'.DS;

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->baseDir  =dirname(dirname(APP)).DS.'ser'.DS.'api'.DS.'records'.DS;;
	}	
	function getProfilePic($student){
		$formats = array('png','jpg','jpeg');
		$i=0;
		$hasProfile =false;
		$pPath = $this->imgPath($student);
		$file = null;
		do{
			$ext =  $formats[$i];
			$filename =  'profile-pic.'.$ext;
			$path = $pPath.$filename;	
			$file =  new File($path);
			$hasProfile = $file->exists();
			$i++;
		}while( !$hasProfile && $i<3);
		$filePath = null;
		if($hasProfile){
			$filePath =  $path;
		}
		return $filePath;
	}
	
	
	function uploadFile($fileObj, $meta){
		$file =  new File($fileObj['tmp_name']);
		$ext = end((explode(".", $fileObj['name'])));
		
		$imgTypes = array('image/png','image/jpeg');
		$type = "docs";
		if(isset($meta['type'])){
			$type = $meta['type'];
		}else if(in_array($fileObj['type'], $imgTypes)){
			$type = 'img';
		}

		$SID = isset($meta['student_id'])?$meta['student_id']:'__ALL';
		switch($type){
			case 'profile_pic':
				$path  =$this->imgPath($SID);
				$filename = 'profile-pic.'.$ext;
				$type = 'img';
			break;
			default:
				$filename = $fileObj['name'];
				$this->updateManifest($type,$filename,$SID);
				if($type=='img'||$type=='qr'){
					$path= $this->imgPath($SID);
				}else{
					$path = $this->docsPath($SID);
				}
				
				$filename = $fileObj['name'];
			break;

		}

		$filePath =  $path.$filename;
		$data = $file->read();
        $file->close();

		$nFile = new File($filePath);
        $nfE = $exists = $nFile->exists();
        $fType = $type!='img'?'docs':'img';
        $this->registerFile($filename,$SID,$fType);
        if(!$nfE){
    		$nFile->create();
        }
        $nFile->write($data);
        $nFile->close();
        $fileInfo =  array('name'=>$filename);
        return $fileInfo;
	}
	function createJSONFile($student,$data,$filename){
		$filePath = $this->docsPath($student).$filename;

		$nFile = new File($filePath);
		$json = json_encode($this->utf8ize($data),JSON_PRETTY_PRINT);
        $this->registerFile($filename,$student,'docs');
        $nFile->create();
        $nFile->write($json);
        $nFile->close();
        $fileInfo =  array('name'=>$filename);
        return $json;
	}
	function verifyFile($refNo, $student,$type,$code){
		$filename =null;
		$isVerified = false;
		$contents = null;
		$vObj = null;
		switch($type){
			case 'frno':
				$filename =  'frno-'.$refNo.'-'.$student.'.json';
			break;
		}
		if($filename){
			$path =  $this->docsPath($student);
			$filePath =  $path.$filename;
			$file =  new File($filePath);
			if($file){
				$contents = $file->read();
				$verify = strtoupper(substr(md5($contents),0,6));
				$code = strtoupper($code);
				$isVerified = $verify==$code;
				if($isVerified){
					$vObj['verified'] =  true;
					$vObj['contents'] =  json_decode($contents,true);
					$vObj['contents']['student_info']['request']['verified']=true;
					$vObj['contents']['student_info']['request']['qrcode']['token']=$code;
				}
			}
		}
		return $vObj;
	}
	function registerFile($filename,$student,$type="docs",$data=""){

		$path = $this->docsPath($student);
		switch($type){
			case 'img':	case 'qr':
				$path =  $this->imgPath($student);
			break;
			default:
				$type = 'docs';
			break;

		}
		

		$fullPath = $filePath =  $path.$filename;
		
		$nFile = new File($filePath);
        $nfE = $exists = $nFile->exists();
        $ctr=1;

        if($type=='qr'):
        	$mObj = $this->readManifest($student);
        	$mData = $mObj['data'];
        	$hash = md5($filename.$data);
        	if($exists):
	        	$duplicate = in_array($hash,$mData['hash']);
	        	if($duplicate):
		        	$fullPath = array('duplicate'=>true,'path'=>$fullPath);
		        	return $fullPath;
		        else:
		        	$this->updateManifest('hash',$hash,$student);
	        	endif;
	        	
	        else:
	        	$this->updateManifest('hash',$hash,$student);
        	endif;
        	
        endif;

        while($exists){
        	$nInfo = $nFile->info();
    		$filePath = $nInfo['dirname'].DS.$nInfo['filename'].'-v'.$ctr.'.'.$nInfo['extension'];
    		$ctr++;
    		$rFile = new File($filePath);
    		$exists = $rFile->exists();

    		// Copy old file to new file with suffix -v#
    		if(!$exists){
    			$rFile->create();
    			$rInfo = $rFile->info();
    			$this->updateManifest('img',$rInfo['basename'],$student);
    			$nData = $nFile->read();
    			$rFile->write($nData);
    		}
    		$rFile->close();

        };

        if(!$nfE){
    		$nFile->create();
    		$this->updateManifest('img',$filename,$student);
        }
        $nFile->close();
        
		return $fullPath;
	}
	protected function readManifest($student){
		$manifest = new File($this->manifestPath($student),true,0777);
		$mData =  json_decode($manifest->read(),true);
		if(!$mData){
			$mInfo =  $manifest->info();
			$mData = array(
				'student_id'=>$student,
				'path'=>$mInfo['dirname'],
				'img'=>array(),
				'hash'=>array(),
				'docs'=>array(),
				'created'=>date('Y-M-d H:m:i',time()),
				'modified'=>date('Y-M-d H:m:i',time())
			);
		}

		if(!isset($mData['hash'])){
			$mData['hash'] = array();
			$fData = json_encode($this->utf8ize($mData),JSON_PRETTY_PRINT);
			$manifest->write($fData);
		}
		$mObj = array('file'=>$manifest,'data'=>$mData);
		return $mObj;
	}
	protected function updateManifest($field,$file,$student){
		// Update manifest file
		$mObj =  $this->readManifest($student);
		$mData = $mObj['data'];
		$manifest = $mObj['file'];
		switch($field){
			case 'img':
				array_push($mData['img'],$file);
			break;
			case 'hash':
				array_push($mData['hash'],$file);
			break;
			default:
				array_push($mData['docs'],$file);
			break;
		}

		$mData['modified']= date('Y-M-d H:m:i',time());
		$mData =  json_encode($mData,JSON_PRETTY_PRINT);
		$manifest->write($mData);
		$manifest->close();

	}

	protected function utf8ize( $mixed ) {
	    if (is_array($mixed)) {
	        foreach ($mixed as $key => $value) {
	            $mixed[$key] = $this->utf8ize($value);
	        }
	    } elseif (is_string($mixed)) {
	        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
	    }
	    return $mixed;
	}


	protected function manifestPath($student){
		if(!$student) $student = '__ALL';
		$studPath = $this->baseDir.$student.DS;
		
		$manifestFolder = new Folder($studPath,true,0775);
		$path = $studPath.'manifest.json';
		return $path;
	}
	protected function imgPath($student){
		if(!$student) $student = '__ALL';
		$path = $this->baseDir.$student.DS.'img'.DS;
		$imgFolder = new Folder($path,true,0775);
		return $path;
	}
	protected function docsPath($student){
		if(!$student) $student = '__ALL';
		$path = $this->baseDir.$student.DS.'docs'.DS;
		$docsFolder = new Folder($path,true,0775);
		return $path;
	}
}