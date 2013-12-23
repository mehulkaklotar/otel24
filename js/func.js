// JavaScript Document
function hide()
{
   if(document.frmm.check_radio[0].checked==true)
   {
     document.getElementById('img').style.display='';
	 document.getElementById('ur').style.display='none';
	 document.getElementById('1').style.display='none';
	 document.getElementById('add').style.display='none';
	 document.getElementById('javaup').style.display='';
	 document.getElementById('subup').style.display='none';
   }
   else
   {
     document.getElementById('img').style.display='none';
	  document.getElementById('1').style.display='';
	 document.getElementById('ur').style.display='';
	 document.getElementById('add').style.display='';
	 document.getElementById('javaup').style.display='none';
	 document.getElementById('subup').style.display='';
   }
}


function add_more(val)
{
if(val!=10)
{
document.getElementById(val).innerHTML="<table width='100%'><tr><td align='right' valign='top' class='black_txt' ></td><td width='70%' align='left' valign='middle' style='padding-left:0px; '><input type='text' class='black_txt' name='url[]' style='width:250px; '></td></tr><tr><td align='right' valign='top' class='black_txt' colspan='2' id='"+(val+1)+"' style='padding-right:5px; ' ></td></tr></table>";
document.getElementById('td1').innerHTML="<a href='javascript:void(0)' class='blue_txt' onClick='add_more("+(val+1)+")'>Add more..</a>";
}
}

function validind(obj)
{
/*
if(obj.type1.value=='')
{
alert("Please Select Content Type");
return false;
}
else
{
return true;
}*/
}


function validate(obj)
{
$('#fileUploadname3').fileUploadStart();

}

function log_valid(obj)
		   {
		     if(obj.username.value==''){
			  alert("Please Enter Username");
			  return false;
			 }else if(obj.password.value==''){
			  alert("Please Enter Password");
			  return false;
			 }else{
			 return true;
			 }
		   }