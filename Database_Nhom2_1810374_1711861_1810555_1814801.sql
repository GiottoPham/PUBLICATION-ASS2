SET FOREIGN_KEY_CHECKS =0; 
drop schema if exists Publication;
create schema Publication;
Use Publication;
SET FOREIGN_KEY_CHECKS =1;
-- ddl
create table scientist(
	id char(10),	
	last_name varchar(255) not null,
	middle_name varchar(255),
	first_name varchar(255) not null,
	phone char(11),
    address varchar(255),
    `organization` varchar(255),
    job varchar(255),
	primary key(id)
);

create table `account`(
	id char(10) primary key,
    username varchar(20),
    `password` varchar(20),
    foreign key (id) references scientist(id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table book(
	isbn char(13),
    `name` varchar(255) not null,
    publish_year year,
    total_page int,
    publisher varchar(255),
	primary key(isbn)

);
create table reviewer(
	id char(10),	
    business_email varchar(255),
	personal_email varchar(255),
	collaboration_date date,
    qualification varchar(255),
	primary key(id),
	foreign key(id) references  scientist(id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table editor(
	id char(10),
	primary key(id),
	foreign key(id) references  scientist(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create table author(
	id char(10),
    author_email varchar(255),
	primary key(id),
	foreign key(id) references  scientist(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create table paper(
	paper_id char(10),
	title varchar(255) not null,
    summary varchar(255),
    paper_file varchar(255),
    post_date date,
    `status` varchar(255) check (`status` in ('in review', 'response review', 'complete review', 'publishing', 'posted')),
    after_review_result varchar(255),
    final_result varchar(255) check(final_result in('rejection','minor revision','acceptance','major revision')),
    announce_date date,
    editor_id char(10) not null,
    contact_author_id char(10) not null,
    note_for_author varchar(255),
    primary key(paper_id),
	foreign key(editor_id) references  editor(id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(contact_author_id) references  author(id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table research_paper(
	paper_id char(10),
    research_page_number int not null check(research_page_number>=10 and research_page_number<=20),
	primary key(paper_id),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table general_paper(
	paper_id char(10),
    general_page_number int not null check(general_page_number>=3 and general_page_number<=10),
	primary key(paper_id),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table review_paper(
	paper_id char(10),
	review_page_number int not null check(review_page_number>=3 and review_page_number<=6),
    isbn char(13) not null,
	primary key(paper_id),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(isbn) references  book(isbn) ON DELETE CASCADE ON UPDATE CASCADE
);

create table published_paper(
	doi varchar(255),	
    published_type varchar(255) not null check (published_type in ('traditional','open access')),
    paper_id char(10),
	primary key(doi),
	foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE

);
create table author_names(
	isbn char(13),	
    author_name varchar(255),
    primary key(isbn,author_name),
    foreign key(isbn) references  book(isbn) ON DELETE CASCADE ON UPDATE CASCADE
);
create table keywords(
	paper_id char(10),
    keyword varchar(255),
    primary key(paper_id, keyword),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table criteria(
	criteria_id char(10),
    content varchar(255),
	primary key(criteria_id)
);
create table rating_level(
	criteria_id char(10),
   `description` varchar(255),
    score float,
    unique(criteria_id, score),
    primary key(criteria_id,`description`,score),
    foreign key(criteria_id) references  criteria(criteria_id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table evaluate(
	paper_id char(10),
    reviewer_id char(10),
    criteria_id char(10),
    primary key(paper_id,reviewer_id,criteria_id),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(reviewer_id) references  reviewer(id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(criteria_id) references  criteria(criteria_id) ON DELETE CASCADE ON UPDATE CASCADE
    
);
create table assign(
	paper_id char(10),
    reviewer_id char(10),
	editor_id char(10),
    assign_date date,
    review_expired_date date,
    constraint check(assign_date<review_expired_date),
    primary key(paper_id,reviewer_id),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(reviewer_id) references  reviewer(id) ON DELETE CASCADE ON UPDATE CASCADE,
	foreign key(editor_id) references  editor(id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table review(
	paper_id char(10),
    reviewer_id char(10),
    note_for_author varchar(255),
    note_for_editor varchar(255),
    review_result varchar(255),
    primary key(paper_id,reviewer_id),
    foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(reviewer_id) references  reviewer(id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table `write`(
	paper_id char(10),
    author_id char(10),
    primary key(paper_id,author_id),
	foreign key(paper_id) references  paper(paper_id) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key(author_id) references  author(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ADD DATA
insert into scientist
values ('0000000001','Pham','Van','An','0854662611','Quan 1','ABC Company','Manager'),
('0000000002','Pham','Van','Ba','0854662612','Quan 2','BCD Company','Manager'),
('0000000003','Pham','Van','Cang','0854662613','Quan 3','Group2 Publication','Employee'),
('0000000004','Pham','Van','Dan','0854662614','Quan 4','Group2 Publication','Employee'),
('0000000005','Nguyen','Thi','Na','0854662615','Quan 5','Group2 Publication','Employee'),
('0000000006','Nguyen','Thi','Van','0854662616','Quan Thu Duc','Group2 Publication','Employee'),
('0000000007','Nguyen','Thi','Giang','0854662617','Quan Binh Thanh','Group2 Publication','Editor'),
('0000000008','Nguyen','Thi','Hop','0854662618','Quan Go Vap','Group2 Publication','Editor');

INSERT INTO account VALUES('0000000001','hello1','hello1');
INSERT INTO account VALUES('0000000002','hello2','hello2');
INSERT INTO account VALUES('0000000003','hello3','hello3');
INSERT INTO account VALUES('0000000004','hello4','hello4');
INSERT INTO account VALUES('0000000005','hello5','hello5');
INSERT INTO account VALUES('0000000006','hello6','hello6');
INSERT INTO account VALUES('0000000007','hello7','hello7');
INSERT INTO account VALUES('0000000008','hello8','hello8');

insert into author
values ('0000000001','an@gmail.com'),
('0000000002','ba@gmail.com'),
('0000000003','cang1@gmail.com');

insert into reviewer
values ('0000000003','cang1@gmail.com','cang2@gmail.com','2015-01-02','Graduated from BK University'),
('0000000004','dan1@gmail.com','dan2@gmail.com','2015-01-03','Graduated from KHTN University'),
('0000000005','na1@gmail.com','na2@gmail.com','2015-01-04','Graduated from XHNV University'),
('0000000006','van1@gmail.com','van2@gmail.com','2015-01-05','Graduated from QT University');

insert into editor
values ('0000000005'),  ('0000000006'),  ('0000000007'),  ('0000000008');

insert into paper(paper_id,title,summary,paper_file,editor_id,contact_author_id,post_date,final_result,`status`)
values ('P000000001','Machine Learning of Tensorflow',
'Quantile regression is an indispensable tool for statistical learning. Traditional quantile regression methods consider vector-valued covariates and estimate the corresponding coefficient vector.',
'https://www.jmlr.org/papers/volume21/19-585/19-585.pdf','0000000005','0000000001','2020-12-5','rejection','in review'),
('P000000002','Healthy General','The aim of this study was to compare the defined indicators of tuberculosis (TB) control program in
the intervention and control prisons.','https://www.emerald.com/insight/content/doi/10.1108/JHR-04-2019-0074/full/pdf?title=comparison-of-tuberculosis-indicators-after-implementation-of-the-clinical-protocol-for-tuberculosis-and-hiv-management-in-iranian-prisons-a-quasi-experimental-study','0000000006','0000000002','2019-10-29','acceptance','posted'),
('P000000003','Review of Hello World','There has been a flowering of scholarly interest in the literature review as a research method in the information
systems discipline','https://core.ac.uk/download/pdf/301376904.pdf','0000000007','0000000001','2015-10-28','rejection',null),
('P000000004','Review of Alice in Wonderland','The aim of this review was to show everyone the thrilling of Alice in Wonderlan book.','http://www.ysgolgymraeg.ceredigion.sch.uk/gwaith_plant/Review%20Alice%20in%20Wonderland.pdf','0000000008','0000000002','2018-10-27','acceptance','posted');

insert into research_paper VALUES('P000000001',15);
insert into general_paper VALUES('P000000002',8);

insert into book(isbn,`name`)
values('1231231231231','Hello World');
insert into book(isbn,`name`)
values('1231231231232','Alice in Wonderland');

insert into review_paper VALUES('P000000003',3,'1231231231231');
insert into review_paper VALUES('P000000004',4,'1231231231232');

insert into published_paper values('10.111/dome.12082', 'traditional','P000000004');
insert into published_paper values('10.111/dome.13444', 'open access','P000000002');

insert into criteria values('C000000001','ND1');
insert into criteria values('C000000002','ND2');

insert into rating_level values('C000000001','LV1',5);
insert into rating_level values('C000000001','LV2',10);
insert into rating_level values('C000000002','LV1',4);
insert into rating_level values('C000000002','LV2',6);
insert into rating_level values('C000000002','LV3',8);
insert into rating_level values('C000000002','LV4',10);

insert into `write` values('P000000001','0000000001');
insert into `write` values('P000000002','0000000001');
insert into `write` values('P000000002','0000000002');
insert into `write` values('P000000003','0000000001');
insert into `write` values('P000000003','0000000002');
insert into `write` values('P000000003','0000000003');
insert into `write` values('P000000004','0000000002');

insert into assign(paper_id,reviewer_id,editor_id, assign_date) 
values('P000000001','0000000003', '0000000005', '2020-6-12');
insert into assign(paper_id,reviewer_id,editor_id,assign_date)  
values('P000000002','0000000003', '0000000006','2019-10-30');
insert into assign(paper_id,reviewer_id,editor_id,assign_date) 
values('P000000002','0000000004', '0000000006','2019-10-30');
insert into assign(paper_id,reviewer_id,editor_id,assign_date) 
values('P000000003','0000000005', '0000000007', '2015-10-29');
insert into assign(paper_id,reviewer_id,editor_id,assign_date) 
values('P000000004','0000000004', '0000000008','2018-10-30');
insert into assign(paper_id,reviewer_id,editor_id,assign_date) 
values('P000000004','0000000005', '0000000008','2018-10-30');
insert into assign(paper_id,reviewer_id,editor_id,assign_date) 
values('P000000004','0000000006', '0000000008','2018-10-30');

insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000001','0000000003', 'C000000001');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000002','0000000003', 'C000000002');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000002','0000000004', 'C000000002');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000003','0000000005', 'C000000001');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000003','0000000005', 'C000000002');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000004','0000000004', 'C000000001');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000004','0000000005', 'C000000001');
insert into evaluate(paper_id,reviewer_id,criteria_id) 
values('P000000004','0000000006', 'C000000001');

insert into review(paper_id,reviewer_id,review_result)
values('P000000001','0000000003','Good');
insert into review(paper_id,reviewer_id,review_result)
values('P000000002','0000000003','Not Good');
insert into review(paper_id,reviewer_id,review_result)
values('P000000002','0000000004','Bad');
insert into review(paper_id,reviewer_id,review_result)
values('P000000003','0000000005','Very Good');
insert into review(paper_id,reviewer_id,review_result)
values('P000000004','0000000004','Normal');
insert into review(paper_id,reviewer_id,review_result)
values('P000000004','0000000005','Normal');
insert into review(paper_id,reviewer_id,review_result)
values('P000000004','0000000006','Normal');


 





