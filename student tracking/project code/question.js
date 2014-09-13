var count=0;//used to give unique ids
var question_count=0;
var maximum_score=0;
var default_question= "Enter Question";
var default_option="Enter Option";
function clearOption(x)
{
if(x==default_option)
return '';
return x;
}
function clearQuestion(x)
{
if(x==default_question)
return '';
return x;
}
function validateSingleCorrect(array)
{
for(i=2;i<=8;i+=2)
if(array[i].value==''||array[i].value==default_option)
{
alert("Please provide all the options");return false;
}
if((array[1].checked || array[3].checked || array[5].checked || array[7].checked )==false)
{alert("Please provide a correct answer");return false;}
return true;
}
function validateMultipleCorrect(array)
{
for(i=2;i<=8;i+=2)
if(array[i].value==''||array[i].value==default_option)
{
alert("Please provide all the options");return false;
}
if((array[1].checked || array[3].checked || array[5].checked || array[7].checked )==false)
{alert("Please provide a correct answer");return false;}
return true;
}
function validateTrueFalse(array)
{
if((array[1].checked || array[2].checked )==false)
{alert("Please provide a correct answer");return false;}
return true;
}
function updateDisplay(delta_question_count,delta_maximum_score)
{
	question_count=question_count+delta_question_count;
	maximum_score=maximum_score+parseInt(delta_maximum_score);
	var C=document.getElementById('display');
	C.innerHTML="Questions Added="+question_count+"\t"+"Maximum Score="+maximum_score;
	
	A=document.getElementById('hiddennumquesid');
	A.value=question_count;
	A=document.getElementById('hiddenmaximmarksid');
	A.value=maximum_score;

}
function checknumQuestions()
{
	if(question_count==0)
	{
		alert('No questions entered');
		return false;
	}

}
function leftover(newdiv)
{
	var A=document.getElementById('target_divid');
	A.appendChild(newdiv);
	var delta_maximum_score=document.getElementById("Q"+(count+1)+"posmarks").value;
	count=count+1;
	updateDisplay(1,delta_maximum_score);
	var A=document.getElementById('addnewquesbtnid');
	A.style.visibility='visible';A.focus();
	document.getElementById("quesformid").innerHTML="";

}
function deleteQuestion(parent)
{
var question_id=document.getElementById("Q"+parent.id+"serverid").value;
var delta_maximum_score=document.getElementById("Q"+parent.id+"posmarks").value;
delta_maximum_score=-1*delta_maximum_score;
$.ajax(
	{
		url:"delete_question.php",
		type:"POST",
		data: 	{
					question_id:question_id,
					
				},
		success: function(result){
		if(result==-1)alert("Error in Question Deletion. Retry:(");
		else
		{
			parent.parentNode.removeChild( parent );
			updateDisplay(-1,delta_maximum_score);
	
		}
	}
	})
}
function editSingleCorrect(parent)
{
var element=document.getElementById("Q"+parent.id+"title");
element.disabled=false;
for(i=0;i<4;i++)
{
	var element=document.getElementById("Q"+parent.id+"radiobtn"+(i+1));
	element.disabled=false;
	var element=document.getElementById("Q"+parent.id+"option"+(i+1));
	element.disabled=false;
}
var element=document.getElementById("Q"+parent.id+"editbtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"deletebtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"okbtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"posmarks");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"negmarks");
element.disabled=false;
}

function freezeSingleCorrect(parent)
{
var delta_maximum_score=parseInt(document.getElementById("Q"+parent.id+"posmarks").value)-parseInt(document.getElementById("Q"+parent.id+"oldposmarks").value);
var element=document.getElementById("Q"+parent.id+"title");
element.disabled=true;
for(i=0;i<4;i++)
{
	var element=document.getElementById("Q"+parent.id+"radiobtn"+(i+1));
	element.disabled=true;
	var element=document.getElementById("Q"+parent.id+"option"+(i+1));
	element.disabled=true;
}
var element=document.getElementById("Q"+parent.id+"editbtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"deletebtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"okbtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"posmarks");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"negmarks");
element.disabled=true;

var title=document.getElementById("Q"+parent.id+"title").value;
var type=document.getElementById("Q"+parent.id+"type").value;
var question_id=document.getElementById("Q"+parent.id+"serverid").value;
var option=new Array();
var option_flag=new Array();
var positive_marks=document.getElementById("Q"+parent.id+"posmarks").value;
var negative_marks=document.getElementById("Q"+parent.id+"negmarks").value;
for(i=0;i<4;i++)
{
	option[i]=document.getElementById("Q"+parent.id+"option"+(i+1)).value;
	if(document.getElementById("Q"+parent.id+"radiobtn"+(i+1)).checked==true)option_flag[i]=1;
	else option_flag[i]=0;
}
$.ajax(
	{
		url:"edit_question.php",
		type:"POST",
		data: 	{
					title:title,type:type,question_id:question_id,
					option1:option[0],option2:option[1],option3:option[2],option4:option[3],
					option1_flag:option_flag[0],option2_flag:option_flag[1],option3_flag:option_flag[2],option4_flag:option_flag[3],
					positive_marks:positive_marks,negative_marks:negative_marks
				},
		success: function(result){
		if(result==-1)alert("Error in Question Edit. Retry:(");
		else
		{updateDisplay(0,delta_maximum_score);document.getElementById("Q"+parent.id+"oldposmarks").value=document.getElementById("Q"+parent.id+"posmarks").value;
		}
	}
	})
}
function setId(idelement,result)
{
idelement.setAttribute("value",result);
}
function insertSingleCorrect(childinputs)
{
	var flag=validateSingleCorrect(childinputs);
	if(!flag) return ;	
	var num=4;
	var exam_id=document.getElementById('hiddenexamid').value;
	var title=document.getElementById('titleid').value;
	var option=new Array();
	var option_flag=new Array();
	var positive_marks;
	var negative_marks;
	for(i=0;i<num;i++)option_flag[i]=0;
	
	var newdiv=document.createElement("div");
	newdiv.id=count+1;
	
	var element=document.createElement("input");
	element.setAttribute("type", "text");
	element.setAttribute("size",190);
	element.setAttribute("id","Q"+(count+1)+"title");
	element.setAttribute("value",document.getElementById('titleid').value);
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"editbtn");
	element.setAttribute("value","Edit");
	element.setAttribute("onclick","editSingleCorrect(this.parentNode)")
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"deletebtn");
	element.setAttribute("value","Delete");
		element.setAttribute("onclick","deleteQuestion(this.parentNode)");
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"okbtn");
	element.setAttribute("value","Ok");
	element.setAttribute("onclick","freezeSingleCorrect(this.parentNode)")
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "hidden");
	element.setAttribute("id", "Q"+(count+1)+"type");
	element.setAttribute("value", "singlecorrect");
	newdiv.appendChild(element);
	
	newdiv.appendChild(document.createElement("br"));
	element = document.createElement('select');
	element.setAttribute("id","Q"+(count+1)+"posmarks");
	var op=new Array();
	for(i=0;i<10;i++){op[i]=new Option();op[i].value=(i+1);op[i].text=(i+1);element.options.add(op[i]);}
	newdiv.innerHTML=newdiv.innerHTML+"Positive Score";
	var temp= document.getElementById('posmarksid').value;
	positive_marks=temp;
	op[temp-1].setAttribute("selected",true);
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "hidden");
	element.setAttribute("id", "Q"+(count+1)+"oldposmarks");
	element.setAttribute("value", temp);
	newdiv.appendChild(element);
	
	
	element = document.createElement('select');
	element.setAttribute("id","Q"+(count+1)+"negmarks");
	var op=new Array();
	for(i=0;i<10;i++){op[i]=new Option();op[i].value=-(i);op[i].text=-(i);element.options.add(op[i]);}
	var temp= document.getElementById('negmarksid').value;
	negative_marks=temp;
	temp=-temp;
	op[temp].setAttribute("selected",true);
	element.setAttribute("disabled",true);
	newdiv.innerHTML=newdiv.innerHTML+"Negative Score";
	newdiv.appendChild(element);
	
	newdiv.appendChild(document.createElement("br"));
	
	for( i=0; i< num;i++ )
	{
		var index=2*(i)+1;
		var element=document.createElement("input");
		element.setAttribute("type", "radio");
		element.setAttribute("id", "Q"+(count+1)+"radiobtn"+(i+1));
		element.setAttribute("name", "Q"+(count+1)+"radiobtn");
		element.setAttribute("value", (i+1));
		if (childinputs[index].checked){element.setAttribute("checked",true);option_flag[i]=1;}
		element.setAttribute("disabled",true);
		newdiv.appendChild(element);
		var element=document.createElement("input");
		element.setAttribute("type", "text");
		element.setAttribute("id", "Q"+(count+1)+"option"+(i+1));
		element.setAttribute("value", childinputs[index+1].value);option[i]=childinputs[index+1].value;
		element.setAttribute("disabled",true);
		newdiv.appendChild(element);
		
		newdiv.appendChild(document.createElement("br"));
	}
	
	idelement=document.createElement('input');
	idelement.setAttribute("type", "hidden");
	idelement.setAttribute("id", "Q"+(count+1)+"serverid");
	idelement.setAttribute("value", "");
	newdiv.appendChild(idelement);
	$.ajax(
	{ 
		url:"create_question.php",
		type:"POST",
		data: 	{
					exam_id:exam_id,title:title,type:"singlecorrect",
					option1:option[0],option2:option[1],option3:option[2],option4:option[3],
					option1_flag:option_flag[0],option2_flag:option_flag[1],option3_flag:option_flag[2],option4_flag:option_flag[3],
					positive_marks:positive_marks,negative_marks:negative_marks
				},
		success: function(result){
		if(result==-1)alert("Error in Question Creation. Retry:(");
		else 
		{
			setId(idelement,result);
		}
	}
	});
	leftover(newdiv);
}

function editMultipleCorrect(parent)
{
var element=document.getElementById("Q"+parent.id+"title");
element.disabled=false;
for(i=0;i<4;i++)
{
	var element=document.getElementById("Q"+parent.id+"checkbox"+(i+1));
	element.disabled=false;
	var element=document.getElementById("Q"+parent.id+"option"+(i+1));
	element.disabled=false;
}
var element=document.getElementById("Q"+parent.id+"editbtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"deletebtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"okbtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"posmarks");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"negmarks");
element.disabled=false;
}

function freezeMultipleCorrect(parent)
{
var delta_maximum_score=parseInt(document.getElementById("Q"+parent.id+"posmarks").value)-parseInt(document.getElementById("Q"+parent.id+"oldposmarks").value);

var element=document.getElementById("Q"+parent.id+"title");
element.disabled=true;
for(i=0;i<4;i++)
{
	var element=document.getElementById("Q"+parent.id+"checkbox"+(i+1));
	element.disabled=true;
	var element=document.getElementById("Q"+parent.id+"option"+(i+1));
	element.disabled=true;
}
var element=document.getElementById("Q"+parent.id+"editbtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"deletebtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"okbtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"posmarks");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"negmarks");
element.disabled=true;


var title=document.getElementById("Q"+parent.id+"title").value;
var type=document.getElementById("Q"+parent.id+"type").value;
var question_id=document.getElementById("Q"+parent.id+"serverid").value;
var option=new Array();
var option_flag=new Array();
var positive_marks=document.getElementById("Q"+parent.id+"posmarks").value;
var negative_marks=document.getElementById("Q"+parent.id+"negmarks").value;
for(i=0;i<4;i++)
{
	option[i]=document.getElementById("Q"+parent.id+"option"+(i+1)).value;
	if(document.getElementById("Q"+parent.id+"checkbox"+(i+1)).checked==true)option_flag[i]=1;
	else option_flag[i]=0;
}
$.ajax(
	{
		url:"edit_question.php",
		type:"POST",
		data: 	{
					title:title,type:type,question_id:question_id,
					option1:option[0],option2:option[1],option3:option[2],option4:option[3],
					option1_flag:option_flag[0],option2_flag:option_flag[1],option3_flag:option_flag[2],option4_flag:option_flag[3],
					positive_marks:positive_marks,negative_marks:negative_marks
				},
		success: function(result){
		if(result==-1)alert("Error in Question Edit. Retry:(");
		else
		{updateDisplay(0,delta_maximum_score);document.getElementById("Q"+parent.id+"oldposmarks").value=document.getElementById("Q"+parent.id+"posmarks").value;
		}
	}
	})

}
function insertMultipleCorrect(childinputs)
{
	var flag=validateMultipleCorrect(childinputs);
	if(!flag) return;
	var num=4;
	var exam_id=document.getElementById('hiddenexamid').value;
	var title=document.getElementById('titleid').value;
	var option=new Array();
	var option_flag=new Array();
	var positive_marks,negative_marks;
	for(i=0;i<num;i++)option_flag[i]=0;
	
	var newdiv=document.createElement("div");
	newdiv.id=count+1;//starting from div0
	
	var element=document.createElement("input");
	element.setAttribute("type", "text");
	element.setAttribute("size",190);
	element.setAttribute("id","Q"+(count+1)+"title");
	element.setAttribute("value",document.getElementById('titleid').value);
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"editbtn");
	element.setAttribute("value","Edit");
	element.setAttribute("onclick","editMultipleCorrect(this.parentNode)")
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"deletebtn");
	element.setAttribute("value","Delete");
		element.setAttribute("onclick","deleteQuestion(this.parentNode)");
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"okbtn");
	element.setAttribute("value","Ok");
	element.setAttribute("onclick","freezeMultipleCorrect(this.parentNode)")
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	newdiv.appendChild(document.createElement("br"));
	
	element=document.createElement("input");
	element.setAttribute("type", "hidden");
	element.setAttribute("id", "Q"+(count+1)+"type");
	element.setAttribute("value", "multiplecorrect");
	newdiv.appendChild(element);
	
	element = document.createElement('select');
	element.setAttribute("id","Q"+(count+1)+"posmarks");
	var op=new Array();
	for(i=0;i<10;i++){op[i]=new Option();op[i].value=(i+1);op[i].text=(i+1);element.options.add(op[i]);}
	var temp= document.getElementById('posmarksid').value;
	positive_marks=temp;
	op[temp-1].setAttribute("selected",true);
	newdiv.innerHTML=newdiv.innerHTML+"Positive Score";
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "hidden");
	element.setAttribute("id", "Q"+(count+1)+"oldposmarks");
	element.setAttribute("value", temp);
	newdiv.appendChild(element);
	
	
	element = document.createElement('select');
	element.setAttribute("id","Q"+(count+1)+"negmarks");
	var op=new Array();
	for(i=0;i<10;i++){op[i]=new Option();op[i].value=-(i);op[i].text=-(i);element.options.add(op[i]);}
	var temp= document.getElementById('negmarksid').value;
	negative_marks=temp;
	op[-temp].setAttribute("selected",true);
	element.setAttribute("disabled",true);
	newdiv.innerHTML=newdiv.innerHTML+"Negative Score";
	newdiv.appendChild(element);
	
	newdiv.appendChild(document.createElement("br"));
	
	for( i=0; i< num;i++ )
	{
		var index=2*(i)+1;
		var element=document.createElement("input");
		element.setAttribute("type", "checkbox");
		element.setAttribute("id", "Q"+(count+1)+"checkbox"+(i+1));
		element.setAttribute("name", "Q"+(count+1)+"checkbox[]");
		element.setAttribute("value", (i+1));
		if (childinputs[index].checked){element.setAttribute("checked",true);option_flag[i]=1;}
		element.setAttribute("disabled",true);
		newdiv.appendChild(element);
		
		var element=document.createElement("input");
		element.setAttribute("type", "text");
		element.setAttribute("id", "Q"+(count+1)+"option"+(i+1));
		element.setAttribute("value", childinputs[index+1].value);option[i]=childinputs[index+1].value;
		newdiv.appendChild(element);
		
		newdiv.appendChild(document.createElement("br"));
		
	}
	idelement=document.createElement('input');
	idelement.setAttribute("type", "hidden");
	idelement.setAttribute("id", "Q"+(count+1)+"serverid");
	idelement.setAttribute("value", "");
	newdiv.appendChild(idelement);
	$.ajax(
	{
		url:"create_question.php",
		type:"POST",
		data: 	{
					exam_id:exam_id,title:title,type:"multiplecorrect",
					option1:option[0],option2:option[1],option3:option[2],option4:option[3],
					option1_flag:option_flag[0],option2_flag:option_flag[1],option3_flag:option_flag[2],option4_flag:option_flag[3],
					positive_marks:positive_marks,negative_marks:negative_marks
				},
		success: function(result){
		if(result==-1)alert("Error in Question Creation. Retry:(");
		else{
			setId(idelement,result);
		}
	}
	})
	leftover(newdiv);
}

function editTrueFalse(parent)
{
var element=document.getElementById("Q"+parent.id+"title");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"radiobtn1");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"radiobtn2");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"editbtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"deletebtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"okbtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"posmarks");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"negmarks");
element.disabled=false;
}

function freezeTrueFalse(parent)
{
var delta_maximum_score=parseInt(document.getElementById("Q"+parent.id+"posmarks").value)-parseInt(document.getElementById("Q"+parent.id+"oldposmarks").value);
var element=document.getElementById("Q"+parent.id+"title");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"radiobtn1");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"radiobtn2");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"editbtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"deletebtn");
element.disabled=false;
var element=document.getElementById("Q"+parent.id+"okbtn");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"posmarks");
element.disabled=true;
var element=document.getElementById("Q"+parent.id+"negmarks");
element.disabled=true;


var title=document.getElementById("Q"+parent.id+"title").value;
var type=document.getElementById("Q"+parent.id+"type").value;
var question_id=document.getElementById("Q"+parent.id+"serverid").value;
var positive_marks=document.getElementById("Q"+parent.id+"posmarks").value;
var negative_marks=document.getElementById("Q"+parent.id+"negmarks").value;
var tf_flag;
if(document.getElementById("Q"+parent.id+"radiobtn1").checked==true)tf_flag=1;
else tf_flag=0;
$.ajax(
	{
		url:"edit_question.php",
		type:"POST",
		data: 	{
					title:title,type:type,question_id:question_id,
					tf_flag:tf_flag,
					positive_marks:positive_marks,negative_marks:negative_marks
				},
		success: function(result){
		if(result==-1)alert("Error in Question Edit. Retry:(");
		else
		{updateDisplay(0,delta_maximum_score);
		document.getElementById("Q"+parent.id+"oldposmarks").value=document.getElementById("Q"+parent.id+"posmarks").value;
		}
	}
	})

}

function insertTrueFalse(childinputs)
{
	var flag=validateTrueFalse(childinputs);
	if(!flag) return;
	
	var newdiv=document.createElement("div");
	newdiv.id=count+1;
	var exam_id=document.getElementById('hiddenexamid').value;
	var title=document.getElementById('titleid').value;
	var positive_marks,negative_marks;
	var element=document.createElement("input");
	element.setAttribute("type", "text");
	element.setAttribute("size",190);
	element.setAttribute("id","Q"+(count+1)+"title");
	element.setAttribute("value",document.getElementById('titleid').value);
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"editbtn");
	element.setAttribute("value","Edit");
	element.setAttribute("onclick","editTrueFalse(this.parentNode)")
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"deletebtn");
	element.setAttribute("value","Delete");
	element.setAttribute("onclick","deleteQuestion(this.parentNode)");
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "button");
	element.setAttribute("size",20);
	element.setAttribute("id","Q"+(count+1)+"okbtn");
	element.setAttribute("value","Ok");
	element.setAttribute("onclick","freezeTrueFalse(this.parentNode)")
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	newdiv.appendChild(document.createElement("br"));
	
	element=document.createElement("input");
	element.setAttribute("type", "hidden");
	element.setAttribute("id", "Q"+(count+1)+"type");
	element.setAttribute("value", "truefalse");
	newdiv.appendChild(element);

	element = document.createElement('select');
	element.setAttribute("id","Q"+(count+1)+"posmarks");
	var op=new Array();
	for(i=0;i<10;i++){op[i]=new Option();op[i].value=(i+1);op[i].text=(i+1);element.options.add(op[i]);}
	var temp= document.getElementById('posmarksid').value;
	positive_marks=temp;
	op[temp-1].setAttribute("selected",true);
	newdiv.innerHTML=newdiv.innerHTML+"Positive Score";
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	
	element=document.createElement("input");
	element.setAttribute("type", "hidden");
	element.setAttribute("id", "Q"+(count+1)+"oldposmarks");
	element.setAttribute("value", temp);
	newdiv.appendChild(element);
	
	
	element = document.createElement('select');
	element.setAttribute("id","Q"+(count+1)+"negmarks");
	var op=new Array();
	for(i=0;i<10;i++){op[i]=new Option();op[i].value=-(i);op[i].text=-(i);element.options.add(op[i]);}
	
	var temp= document.getElementById('negmarksid').value;
	negative_marks=temp;
	op[-temp].setAttribute("selected",true);
	
	element.setAttribute("disabled",true);
	newdiv.innerHTML=newdiv.innerHTML+"Negative Score";
	newdiv.appendChild(element);	

	newdiv.appendChild(document.createElement("br"));
	
	element=document.createElement("input");
	element.setAttribute("type", "radio");
	element.setAttribute("id", "Q"+(count+1)+"radiobtn1");
	element.setAttribute("name", "Q"+(count+1)+"radiobtn");
	element.setAttribute("value", "true");
	if (childinputs[1].checked)
		{
			element.setAttribute("checked",true);
			var tf_flag=1;
		}
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	newdiv.innerHTML=newdiv.innerHTML+"True";
	newdiv.appendChild(document.createElement("br"));
	
	element=document.createElement("input");
	element.setAttribute("type", "radio");
	element.setAttribute("id", "Q"+(count+1)+"radiobtn2");
	element.setAttribute("name", "Q"+(count+1)+"radiobtn");
	element.setAttribute("value", "false");
	if (childinputs[2].checked)
		{
			element.setAttribute("checked",true);
			var tf_flag=0;
		}
	element.setAttribute("disabled",true);
	newdiv.appendChild(element);
	newdiv.innerHTML=newdiv.innerHTML+"False";
	newdiv.appendChild(document.createElement("br"));
	
	idelement=document.createElement('input');
	idelement.setAttribute("type", "hidden");
	idelement.setAttribute("id", "Q"+(count+1)+"serverid");
	idelement.setAttribute("value", "");
	newdiv.appendChild(idelement);
	$.ajax(
	{
		url:"create_question.php",
		type:"POST",
		data: {exam_id:exam_id,title:title,type:"truefalse",tf_flag:tf_flag,
				positive_marks:positive_marks,negative_marks:negative_marks
			},
		success: function(result){
		if(result==-1)alert("Error in Question Creation. Retry:(");
		else{setId(idelement,result);
		}
	
	}
	});
		leftover(newdiv);
}
function insertQuestion()
{
if((document.getElementById("titleid").value == '')||(document.getElementById("titleid").value == default_question))
alert('Please provide the question title');
else if (document.getElementById("typeid").value == -1)
alert('Please select the question type');	
else 
{
	var childinputs = document.getElementById('newquesid').getElementsByTagName('input');
	/*for(i=0;i<childinputs.length;i++){alert(childinputs[i].value);}*/
	if(childinputs[0].value=="singlecorrect")insertSingleCorrect(childinputs);
	else if(childinputs[0].value=="multiplecorrect")insertMultipleCorrect(childinputs);
	else if(childinputs[0].value=="truefalse")insertTrueFalse(childinputs);
}

}
function genSingleCorrect()
{
var A=document.getElementById("newquesid");
A.innerHTML="";
var element=document.createElement("input");
element.setAttribute("type", "hidden");
element.setAttribute("name", "question_type");
element.setAttribute("value", "singlecorrect");
A.appendChild(element);
for(i=0;i<4;i++)
{
element=document.createElement("input");
element.setAttribute("type", "radio");
element.setAttribute("name", "radio");
element.setAttribute("value", "rbtn"+(i+1));
A.appendChild(element);
element=document.createElement("input");
element.setAttribute("type", "text");
element.setAttribute("name", "optionfield"+(i+1));
element.setAttribute("value", default_option);
element.setAttribute("onclick","this.value=clearOption(this.value)");
A.appendChild(element);
A.appendChild(document.createElement("br"));
}
}
function genMultipleCorrect()
{
var A=document.getElementById("newquesid");
A.innerHTML="";
var element=document.createElement("input");
element.setAttribute("type", "hidden");
element.setAttribute("name", "question_type");
element.setAttribute("value", "multiplecorrect");
A.appendChild(element);
for(i=0;i<4;i++)
{
var element=document.createElement("input");
element.setAttribute("type", "checkbox");
element.setAttribute("name", "checkbox[]");
element.setAttribute("value", "cbox"+(i+1));
A.appendChild(element);
element=document.createElement("input");
element.setAttribute("type", "text");
element.setAttribute("name", "optionfield"+(i+1));
element.setAttribute("value", default_option);
element.setAttribute("onclick","this.value=clearOption(this.value)");
A.appendChild(element);
A.appendChild(document.createElement("br"));
}

}
function genTrueFalse()
{
var A=document.getElementById("newquesid");
A.innerHTML="";
var element=document.createElement("input");
element.setAttribute("type", "hidden");
element.setAttribute("name", "question_type");
element.setAttribute("value", "truefalse");
A.appendChild(element);
element=document.createElement("input");
element.setAttribute("type", "radio");
element.setAttribute("name", "correct_ans"+(count+1));
element.setAttribute("value", "true");
A.appendChild(element);
A.innerHTML=A.innerHTML+"True";
element=document.createElement("input");
element.setAttribute("type", "radio");
element.setAttribute("name", "correct_ans"+(count+1));
element.setAttribute("value", "false");
A.appendChild(element);
A.innerHTML=A.innerHTML+"False";

}
function genQuestion()
{
if(document.getElementById("typeid").value == "sc")
	{
        genSingleCorrect();
    }
else if(document.getElementById("typeid").value == "mc")
	{
        genMultipleCorrect();
    }
else if(document.getElementById("typeid").value =="tf")
	{
        genTrueFalse();
    }
}

function openQuesForm()
{
document.getElementById('addnewquesbtnid').style.visibility='hidden';
var A=document.getElementById('quesformid');
A.innerHTML="Question Title";
var element=document.createElement("input");
element.setAttribute("type","text");
element.setAttribute("id","titleid");
element.setAttribute("size",200);
element.setAttribute("value",default_question);
element.setAttribute("onclick","this.value=clearQuestion(this.value)");
A.appendChild(element);
A.appendChild(document.createElement("br"));

A.innerHTML=A.innerHTML+"Question Type";
element = document.createElement('select');
element.setAttribute("id","typeid");
element.setAttribute("onchange","genQuestion()");
var op1= new Option();var op2= new Option();var op3= new Option();var op4= new Option();
op1.value = -1;op2.value = "sc";op3.value ="mc";op4.value ="tf";
op1.text = "---Choose Type---";op2.text = "Single Correct";op3.text = "Multiple Correct";op4.text = "True/False";
element.options.add(op1);
element.options.add(op2);
element.options.add(op3);
element.options.add(op4);
A.appendChild(element);


element = document.createElement('select');
element.setAttribute("id","posmarksid");
var op=new Array();
for(i=0;i<10;i++)
{
	op[i]=new Option();op[i].value=(i+1);op[i].text=(i+1);element.options.add(op[i]);
}
A.innerHTML=A.innerHTML+"Positive Score";
A.appendChild(element);
element = document.createElement('select');
element.setAttribute("id","negmarksid");
var op=new Array();
for(i=0;i<10;i++)
{
	op[i]=new Option();op[i].value=-(i);op[i].text=-(i);element.options.add(op[i]);
}
A.innerHTML=A.innerHTML+"Negative Score";
A.appendChild(element);

element = document.createElement('div');
element.setAttribute("id","newquesid");
A.appendChild(element);

element = document.createElement('input');
element.setAttribute("type","button");
element.setAttribute("onclick","insertQuestion()");
element.setAttribute("value","Done");
A.appendChild(element);
}
