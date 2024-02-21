ALTER TABLE inquiries ADD religion varchar(100) NULL;
ALTER TABLE inquiries CHANGE religion religion varchar(100) NULL AFTER birthplace;
ALTER TABLE inquiries CHANGE mobile mobile char(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL AFTER gender;
ALTER TABLE inquiries CHANGE citizenship citizenship varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL AFTER religion;
ALTER TABLE inquiries CHANGE civil_status civil_status varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL AFTER citizenship;
ALTER TABLE inquiries CHANGE landline landline varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL AFTER mobile;
