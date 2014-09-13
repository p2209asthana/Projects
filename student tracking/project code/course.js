
function clearForm()
{
var A=document.getElementById('createbuttonid');
A.style.visibility='visible';

A=document.getElementById('coursenameid');
A.setAttribute("disabled",true);
A.value="Course Name";
A=document.getElementById('cancelbuttonid');
A.setAttribute("disabled",true);
A=document.getElementById('okbuttonid');
A.setAttribute("disabled",true);
}
function createCourseForm()
{
var A=document.getElementById('createbuttonid');
A.style.visibility='hidden';
A=document.getElementById('coursenameid');
A.value='';
A.disabled=false;
A.focus();
A=document.getElementById('cancelbuttonid');
A.disabled=false;
A=document.getElementById('okbuttonid');
A.disabled=false;
}
function createForm(instructor_id)
{
	var course_name=document.getElementById('coursenameid').value;	
	if(course_name==""){alert("Please Enter the course name");return;}
	var string="course_name="+course_name+"&instructor_id="+instructor_id;
	$.ajax(
	{
		url:"create_course.php",
		type:"POST",
		data:string,
		success: function(result){
		if(result==0)alert("Error in Course Creation . Retry:(");
		else if(result==-1)alert("Course already exists");
		else
		{
			alert("Course Creation Successful :) You can access it from course dropdown list ");
			var A=document.getElementById('selectcourseid');
			var op =new Option();
			op.value=result;
			op.text=document.getElementById('coursenameid').value;
			A.options.add(op);
			clearForm();
		}
		
		
	}
	});
}
