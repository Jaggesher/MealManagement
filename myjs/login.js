function Chk_Valid() {
	var flag=true;
	var _email= document.forms['login_input']['userEmail'].value;
	var _password= document.forms['login_input']['usurePassword'].value;
	 // alert(_password +" "+ _password);
	if(_email==null||_email==''){
		document.getElementById('email').className='redaleart';
		flag=false;
	}

	if(_password==null||_password==''){
		document.getElementById('password').className='redaleart';
		flag=false;
	}
	return flag;
}

function Reform1(){
	document.getElementById('email').className='reform';
}
function Reform2(){
	document.getElementById('password').className='reform';
}