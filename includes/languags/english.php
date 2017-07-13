<?php
function  lang($Phrase){
static $lang=array(
'MyProfile'	   				   =>'My Profile',
'NewAd'	            		   =>'New Ad',
'myItem'	         		   =>'My Item',
'Logout'	   				   =>'Logout',
'Login/Signup' 				   =>'Login/Signup',
'Home Page'    				   =>'Home Page',
//start  the  Login page
'Login'		   				   =>'login',
'signup'	   				   =>'signup',	
'palaceHolderforUsername'	   =>'Enter your  Username Or Your Email  Address',
'palaceHolderforpassword'	   =>'Enter your Password',
'Congrats'	   				   =>'Congrats You Are Registered, User',

//start  the  Sinup part

'firstname'	         		=>'Enter Your first  name',
'lastname'	         		=>'Enter Your last  name',
'YourMobile'         		=>'Enter Your Mobile',
'YourCity'	         		=>'Enter Your City',
'Youraddres'         		=>'Enter Your addres',
'Complexpassword'    		=>'Enter a Complex password ',
'againpassword'			    =>'Enter  a  password again ',
'validEmail'		 		=>'Enter  a valid Email',
'submit'		 		    =>'Submit',

//Start  to  the  Item page

'Showitems'	         		=>'Show items ',
'AddDate:'	         		=>'Add Date ',
'age'         		 		=>'age',
'gander'	         		=>'Gander:',
'LostRelationship:'         =>'Lost Relationship ',
'Addres:'    				=>'Addres ',
'category:'	         		=>'Categories ',
'AddBy:'	         		=>'Add By ',
'tags:'         		 	=>'tags ',
'foundhim'	         		=>'Do you found  him ?',
'theowner'	         		=>'You  are  the  owner',
'noTage'					=>'There  is no Tage  For this Item',
'ShowCategoty'				=>'Categoty ',
'Items'						=>'Items',
'AddYourComment'			=>'Add Your Comment',
'AddComment'				=>'Add Comment',
'CommentAddded'				=>'Comment Addded',

//Start  to  the  Profile if  he  coming  from the item  page  and want  to  see  the  profile of  the  ouner
'theowner'	         		=>'You  are  the  owner',
'name'						=>'Name',
'Mobile'					=>'Mobile',
'city'						=>'city',
'Email'						=>'Email',
'ownerAds'					=>'Other of  this owner Ads',
//start Profile page
'MyProfile'	         		=>'My Profile',
'MyInformation'				=>'My information',
'addres'					=>'Addres',
'RegisterDate'			    =>'Register Date',
'Edit'						=>' Edit',
'MyAds'						=>'My Ads',
'LatestComments'			=>'Latest Comments',
//start Naw AD page
'newPost'	         		=>'Creat new Post',
'country'					=>'country',
'ReportNumber'				=>'Report Number',
'Image'			    		=>'Image',
'Edit'						=>' Edit',
'AddIteme'					=>' Add Iteme',
'desc'						=>'Description ',

'pNameoftheiteme'	        =>'Name of the misssing',
 'age'                      =>'age  of the  missing  ',
 'pdesc'                    =>'Type the missing description',

'paddres'					=>'Addres  of  the  misssing   ',
'pcountry'					=>'country of  the  misssing ',
'pTags'			    		=>'saperat  the Tags  with come(,)',
'pReportNumber'				=>'ReportNumber',
//here  some  massage  in  itemes 
'youbrowsthisdir'			=>'you cannot Browse this page directly You will be sent to the Login page',
'stustasfound'				=>'we Updated your post status to be found',
'RecoredUpadted'			=>'Record Updated',
'ThereisnosuchID'			=>'There is  no  such ID Or this item is Waiting',
'rgisterto'					=>'register Add a comment',
'youmust'					=>'you  must Add Comment ',
'isFoundnow'				=>'is Found  now',
'NOtApprovedyet'			=>'NOt Approved yet',
'NOtfound'					=>'NOt found',
'date'						=>'date',
'datewhen'					=>'date when he  was  missing',

//here  some  massage  in  new itemes 
'MustBeAtLeast4'			=>'Must Be At Least 4 character',
'notBeEmpty'				=>'Item name Must not  Be Empty',


'MustBenotmore3'			=>'Item age Must Be not more  3 characters',
'ageMustnotBeEmpty'			=>'Item age Must not  Be Empty',
'descMustnotBeEmpty'		=>'Item desc Must Be At Least 10 characters',
'countryMustBeAt'			=>'Item country Must Be At Least 2 characters',
'LostRelationshipMust'		=>'Item Lost Relationship Must not  Be Empty',
'ganderMustnot'				=>'Item gander Must not  Be Empty',
'categoriesMustnot'			=>'Item categories Must not  Be Empty',
'ItemisAddedNow'			=>'Item is Added Now',
'man'						=>'man',



'women'						=>'women',
'photo'						=>'the photo not upload',
'father'					=>'father',
'mother'					=>'mother',
'sister'					=>'sister',
'brther'					=>'brother',
'nothaveanyiteminthisC'		=>'We Sit not have any item in this Category until now be the first one to Add',

/// in Editem  member  page  
'EditMembers'				=>'Edit Members',
'Firstname'					=>'First name',
'lastname'					=>'Last name',
'password'					=>'Password',
'save'					    =>'save',



//index 
'Previous'					=>'Previous',
'Next'						=>'Next ',
'why'						=>'why',
'f-p'						=>' Word of loss shaking the soul and mind',
's-p'					    =>'Is a free and multilingual website designed to search missing persons',


'thi-p'						=>'Based on our keenness to play our role in serving our country, we have established our site to meet the needs of our country because we found many children and people missing in all governorates
It helps people of missing people to find their loved ones by displaying pictures accompanied by their own information system and facilitates the handling of user notifications at high speed and effortlessly saves time and facilitates the process of verifying the authenticity of the communication',

'meat-team'					=>'Made  by',

'Islam'						=>'Islam Mamdouh',
'd-Islam'					=>'web Designer',

'Kerolos'					=>'Kerolos M.Ramzy',
'd-Kerolos'					=>'web Designer',
'Ibrahem'					=>'Ibrahem hamdy',
'd-Ibrahem'					=>'Web designer and developer',
'Mohammed'					=>'Mohamed Nagshi',
'd-Mohammed'				=>'Specializing in databases',

'Yehia'						=>'Yehia Ahmad',
'd-Yehia'					=>'Mobile Application Developer',

'tell'						=>'Tell us what you feel',
'count-us'					=>'Send us a message',
'sander'					=>'Your name',
'email'						=>'E-mail',
'phone'						=>'phone number',
'subj'						=>'Subject',
'send'						=>'Send the message',






'werring'					=>'The user of the system must pledge the accuracy and accuracy of the information and data recorded under his personal responsibility, and the site is not responsible for it and the system disclaims any legal liability by publishing the numbers or images',
'info-s'					=>' info about search with me ',
'info-b'					=>'We have established our website to meet the needs of our country. We have found many children and people who are missing in all governorates. They help the people of the missing people to find their loved ones by presenting Images with their own information system can easily handle user notifications at high speed and effortlessly, saves time and facilitates user validation ',
'copyright'						=>'nonprofit organization. © Copyright 2014 - 2017 search with me',



'MissingPerson' =>'Missing Person',
'Unidentified'  =>'Unidentified Person',
'Found'         =>'Found Person',
'nothaveanyiteminthisCategory' =>'empty',

		);
return $lang[$Phrase]; 
}

?>