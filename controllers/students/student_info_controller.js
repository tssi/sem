"use strict";
define(['app','api','atomic/bomb'],function(app){
	app.register.controller('StudentInfoController',['$rootScope','$scope','api','Atomic','aModal','$http','$filter',
		function($rootScope,$scope,api,atomic, aModal,$http,$filter){
			const $selfScope = $scope;
			$scope = this;
			$scope.init = function(){

				$scope.SFormTypes = [
						{id:'AIFF1C', name:'F1C', description:'Admission Inquiry Form'},
						{id:'STU201', name:'201', description:'Admission 201 Form'},
						{id:'STUCLN', name:'CF-1', description:'Clinic Health Form'},
						{id:'STUGUI', name:'GF-1', description:'Guidance Health Form'},
					];
				$scope.AttachmentTypes = [
						{id:'DOXF1C',name:'Inquiry Form1-C'},
						{id:'DOX201',name:'Student 201 Form Signed'}
					];
				$scope.PInfos = [
						{id:'PINFF',name:'Father'},
						{id:'PINFM',name:'Mother'},
						{id:'PINFA',name:'All'},
					];
				$scope.VMTypes= [
						{id:'VMGU',name:'Guardian'},
						{id:'VMFA',name:'Father'},
						{id:'VMMO',name:'Mother'},
						{id:'VMST',name:'Student'}
					];
				$scope.SFormType = 'AIFF1C';
				$scope.FileValidations = {maxSize:1024*1024};
				$scope.Headers = ['LRN','Name','Year Level'];
				$scope.Props = ['lrn','full_name','year_level'];
				$scope.genders = [{'id':'M','name':'Male'},{'id':'F','name':'Female'}];
				$scope.HHeaders = ['Guardian','Relationship'];
				$scope.HProp = ['name','rel'];
				$scope.Ginputs = [{field:'last_name'},{field:'first_name'},{field:'middle_name'},{field:'rel'}];
				$scope.GuardHeader = ['Last Name','First Name', 'Middle Name', 'Relationship'];
				$scope.GuardProp = ['last_name','first_name','middle_name','rel'];
				$scope.SearchBy = ['lrn','full_name'];// Fields you can search from the items 			
				// TODO: Move this to general types config 
				$scope.PrevSchType = [
					{id:'PRV',name:'Private'},
					{id:'PUB',name:'Public'}
				];
				$scope.SexTypes = [
					{id:'M',name:'Male'},
					{id:'F',name:'Female'},
				];
				$scope.LearnSource = [
					{id:'relative',name:'Relatives'},
					{id:'alumni',name:'Alumni'},
					{id:'friends',name:'Friends'},
					{id:'posters',name:'Posters'},
					{id:'neighbors',name:'Neighbors'},
					{id:'school_campaign',name:'School Campaign'},
					{id:'others',name:'Others'},
				];
				
				$scope.entryStats = [{id:"RETURN",name:'Returnee'},{id:"TRNSIN",name:"Transfer In"},{id:"REGLAR",name:"Regular"}];
				$scope.Types = ['Old','New'];
				$scope.StudTypes = [{id:'Old',name:'Old Students'},{id:'New',name:'New Inquiry'}];
				$scope.setActiveTyp('New');
				atomic.ready(function(){
					// Map defaults and options
					$scope.entrySY = atomic.ActiveSY;
					$scope.entryPeriod =atomic.SelectedPeriod.id;
					$scope.entryPeriods = atomic.Periods;
					$scope.entryDepts =  atomic.Departments;
					$scope.entryYrLevels =  atomic.YearLevels;
					$scope.entryProgs =  atomic.Programs;
					$scope.isReady =  true;
					// Filter section dropdown by student department id
					$selfScope.$watch('SI.ActiveStudent.department_id',function(deptId){
						 var sections =  $filter('filter')(atomic.Sections,{department_id:deptId});
						 var yearLevels =  $filter('filter')(atomic.YearLevels,{department_id:deptId});
						 $scope.entrySections = sections;
						 $scope.entryYrLevels = yearLevels;

					});
				}).fuse();
				loadStudents(1);
			};
			$selfScope.$watch('SI.ActiveTyp',function(type){
				loadStudents(1);
			});
			$selfScope.$watch('SI.VMType',function(type){
				let verifyMob;
				switch(type){
					case 'VMGU':
						verifyMob =$scope.ActiveStudent.g_contact_no;
					break;
					case 'VMFA':
						verifyMob =$scope.ActiveStudent.f_mobile;
					break;
					case 'VMMO':
						verifyMob =$scope.ActiveStudent.m_mobile;
					break;
					case 'VMST':
						verifyMob =$scope.ActiveStudent.mobile;
					break;
				}
				$scope.VerifyMobile = verifyMob;
			});
			
			$selfScope.$watch('SI.AttachmentFile.success',function(isOK){
				if(isOK) {
					loadInquiryDocs();
				}
			});
			function loadStudents(page,search){
				$scope.Students = [];
				var filter = {limit:10,page:page};
				if(search){
					filter.keyword = search.keyword;
					filter.fields = search.fields;
				}
				var success =  function(response){
					$scope.Meta =  response.meta;
					$scope.Students =  response.data;
					$scope.CurrentPage =  $scope.Meta.page;
					$scope.NoStudents = false;
				}
				var error = function(response){
					$scope.NoStudents = true;
				}
				if($scope.ActiveTyp=='Old')
					api.GET("students",filter,success,error);
				else{
					filter.sort='latest';
					api.GET("inquiries",filter,success,error);
				}
			}
			
			//SEARCH
			$scope.goToPage = function(page){
				var keyword =  $scope.Searchbox;
				var fields =  $scope.SearchBy;
				if(keyword){
					var search = {keyword:keyword,fields:fields};
					loadStudents(page,search);
				}else{
					loadStudents(page);
				}
			}
			
			$scope.setActiveTyp = function(type){
				$scope.Students = '';
				$scope.ActiveTyp = type;
				if(type=='New'){
					$scope.Headers[0] = 'Ref No';
					$scope.Props[0] = 'id';
				}else{
					$scope.Headers[0] = 'LRN';
					$scope.Props[0] = 'lrn';
				}
				loadStudents()
			}
			
			$scope.search = function(keyword){//Catch the search event to handle loading of items, go to first page
				$scope.Students = '';
				var fields =  $scope.SearchBy;
				var search = {keyword:keyword,fields:fields};
				loadStudents(1,search);
			}
			$scope.clearSearch = function(){// on clear search reset the filter goto page 1
				$scope.Students = '';
				loadStudents(1);
			}
			//END
			
			//MODAL
			$scope.openModal = function(student){

				$scope.saving = false;
				$scope.ActiveTab = $scope.ActiveTyp=='New'?1:0;
				$scope.Active = {};
				$scope.ActiveStudent = '';
				$scope.PInfoShow = 'PINFF';
				$scope.AttachmentFile = null;
				aModal.open('StudentInfoModal');  
				if(student) {
					delete student.classroom_user_id;
					var mLbl = student.first_name[0]+'.' +student.last_name;
					if(student.lrn)	mLbl +=  ' '+ student.lrn;
					$scope.ModalLabel = mLbl;
					if($scope.ActiveTyp=='New')
						$scope.ModalLabel = student.id;
					$scope.ActiveStudent = student;
					loadInquiryDocs();
					
				}else{
					$scope.setActiveTyp('New');
					$scope.ActiveTab = 1;
					$scope.ModalLabel='New Student';
					$scope.ActiveStudent.entry_sy =  $scope.entrySY;
					$scope.ActiveStudent.entry_period =  $scope.entryPeriod;
				}
				
				aModal.open('StudentInfoModal');  
			}		
			
			

			$scope.closeModal = function(mod){
				mod = mod || "StudentInfoModal";
				aModal.close(mod);
				if(mod=='HouseholdModal')
					aModal.open('StudentInfoModal');
			}
			
			$scope.confirmModal = function(){
				$scope.saving = true;
				var data = $scope.ActiveStudent;
				var yl = $filter('filter')(atomic.Sections,{id:data.section_id});
				if(data.section_id)
				data.year_level_id = yl[0].year_level_id;

				if(data.department_id!='SH') data.program_id = null;

				if(data.sno){
					api.POST('students',data,function(response){
						aModal.close("StudentInfoModal");
						if(!$scope.ActiveStudent.id){
							$scope.CurrentPage = $scope.Meta.last;
						}
						
						$scope.goToPage($scope.CurrentPage);
						$scope.Active = response.data;
					});
				}else{
					api.POST('inquiries',data,function(response){
						//aModal.close("StudentInfoModal");
						if(!$scope.ActiveStudent.id){
							$scope.CurrentPage = $scope.Meta.last;
						}
						$scope.saving = false;
						$scope.ActiveTyp = 'New';
						$scope.goToPage(1);
						$scope.Active = response.data;
					});
				}
			}

			$scope.printInfoSheet = function(){
				document.getElementById('PrintInfoSheet').submit();
			}

			$scope.uploadAttachment = function(){
				let studId =  $scope.ActiveStudent.id;
				let docType =  $scope.AttachmentType;
				var meta  = {student_id:studId,type:'document',doc_type:docType}
				$selfScope.$broadcast('FileUploadStart',meta);
			}

			$scope.printForm = function(){
				let formType = $scope.SFormType;
				let formId = 'PrintInfoSheet';
				switch(formType){
					case 'AIFF1C':
						formId = 'PrintInqForm1C';
					break;
					case 'STU201':
						formId = 'PrintInqForm201';
					break;
					case 'STUCLN':
						formId = 'PrintInqFormCF1';
					break;
					case 'STUGUI':
						formId = 'PrintInqFormGF1';
					break;
				}
				document.getElementById(formId).submit();
			}
			
			$scope.viewFile = function(){
				document.getElementById('ViewInqFile').submit();
			}

			function loadInquiryDocs(){
				let inqId = $scope.ActiveStudent.id;
				let filter = {id:inqId};
				$scope.InqDocs = [];
				$scope.IDHeaders = ['Files'];
				$scope.IDProps = ['file'];
				let success = function(response){
					$scope.InqDocs = response.data.docs;
					$scope.AttachmentType = null;
					$scope.AttachmentFile = null;
				};
				let error = function(response){};
				api.GET('inquiries/docs',filter,success,error);
			}
			
	}]);
});