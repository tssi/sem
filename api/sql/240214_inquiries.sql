ALTER TABLE inquiries ADD prev_school_type char(3) NULL;
ALTER TABLE inquiries CHANGE prev_school_type prev_school_type char(3) NULL AFTER prev_school;
ALTER TABLE inquiries ADD prev_school_address varchar(150) NULL;
ALTER TABLE inquiries CHANGE prev_school_address prev_school_address varchar(150) NULL AFTER prev_school_type;
ALTER TABLE inquiries ADD source varchar(50) NULL;
ALTER TABLE inquiries CHANGE source source varchar(50) NULL AFTER id;
