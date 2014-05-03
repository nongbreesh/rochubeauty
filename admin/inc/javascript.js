// JavaScript Document
function check_key_username() {
			use_key=event.keyCode
			if ((use_key < 13) || (use_key >13 && use_key < 45) || (use_key > 45 && use_key < 48) || (use_key > 57 && use_key < 65) || (use_key > 90 && use_key < 95) || (use_key > 95 && use_key < 97) || (use_key > 122)) {
					event.returnValue = false;
					alert("��ͧ�������ѧ���(a-z, A-Z) ���͵���Ţ (0-9) ��������ͧ���� \"-\", ����ͧ���� \"_\" ��ҹ��  \n��������������ä ��سҵ�Ǩ�ͺ... \n\nMust be at letters(a-z, A-Z), number (0-9), \"-\" sign, \"_\" sign, but no space \nPlease check again...");
			}
}
function check_key_eng(use_key) {
			use_key=event.keyCode
			if ((use_key > 160)) {
					event.returnValue = false;
					alert("��ͧ�������ѧ�����ҹ�� ��������ա�������ä \n��سҵ�Ǩ�ͺ...\n\nMust be at English characters Please enter your information again...");
			}
}


function check_key_number() {
			use_key=event.keyCode
			if (use_key != 13 && (use_key < 48) || (use_key > 57)) {
					event.returnValue = false;
					alert("��ͧ�繵���Ţ��ҹ�� ��سҵ�Ǩ�ͺ�����Ţͧ��ҹ�ա����...\n\n(Must be at Number Please enter your information again...");
			}
}
	/*
	Show Div Windows Waiting....
	*/
	function doShowWindowsWait()
	{
	var strBrowserType = navigator.appName.toUpperCase();
	if (strBrowserType.indexOf('MICROSOFT') != -1 || strBrowserType.indexOf('INTERNET') != -1 || strBrowserType.indexOf('EXPLORER') != -1) {
		var intWindowPosLeftCenter = parseInt(document.body.offsetWidth / 2);
		var intWindowPosTopCenter = parseInt(document.body.offsetHeight / 2);
	} else if (strBrowserType.indexOf('NETSCAPE') != -1) {
		var intWindowPosLeftCenter = parseInt(innerWidth / 2);
		var intWindowPosTopCenter = parseInt(innerHeight / 2);
	} else {
		var intWindowPosLeftCenter = 0;
		var intWindowPosTopCenter = 0;
	};
	var strObjectID = "idDivWaitWindow"
	document.getElementById(strObjectID).style.position = "absolute";
	var intObjectWidth = parseInt(document.getElementById(strObjectID).offsetWidth);
	var intObjectHeight = parseInt(document.getElementById(strObjectID).offsetHeight);
	var intObjectPostLeft = intWindowPosLeftCenter - parseInt(intObjectWidth / 2);
	var intObjectPostTop = intWindowPosTopCenter - parseInt(intObjectHeight / 2);
	document.getElementById(strObjectID).style.left = intObjectPostLeft-150;
	document.getElementById(strObjectID).style.top = intObjectPostTop - 25;
	document.getElementById(strObjectID).style.display = '';
	}

/*
Function name	:	numberFormat
Paremeter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
Description	:	��˹�����Ŵ� text ����͹�Ѻ੾�е���Ţ��ҹ��
Useage		:	onKeyPress="return(numberFormat(this,event));"
*/
function 	numberFormat(fld,e)
{
	var strCheck = '123456789';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}

/*
Function name	:	userNameFormate
Paremeter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
Description	:	��˹�����Ŵ� text ����͹�Ѻ੾�е���Ţ��ҹ��
Useage		:	onKeyPress="return(userNameFormate(this,event));"
*/
function 	userNameFormate(fld,e)
{
	var strCheck = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}

/*
Function name	:	PhoneFormat
Paremeter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
Description	:	��˹�����Ŵ� text ����͹�Ѻ�����ŵ������˹�
Useage		:	onKeyPress="return(PhoneFormat(this,event));"
*/
function 	PhoneFormat(fld,e)
{
	var strCheck = '0123456789-#(,)';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}
/*
Function name	:	MobileFormat
Paremeter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
Description	:	��˹�����Ŵ� text ����͹�Ѻ�����ŵ������˹�
Useage		:	onKeyPress="return(MobileFormat(this,event));"
*/
function 	MobileFormat(fld,e)
{
	var strCheck = '0123456789';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}
/*
Function name	:	EmailFormat
Paremeter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
Description	:	��˹�����Ŵ� text ����͹�Ѻ�����ŵ������˹�
Useage		:	onKeyPress="return(EmailFormat(this,event));"
*/
function 	EmailFormat(fld,e)
{
	var strCheck = '0123456789-@abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}
	
/*
Function name	:	StringFormat
Paremeter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
Description	:	��˹�����Ŵ� text ����͹�Ѻ�����ŵ������˹�
Useage		:	onKeyPress="return(StringFormat(this,event));"
*/
function 	StringFormat(fld,e)
{
	var strCheck = ' 1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ�����������ó��°��Ŀ�˯�����ʫǧ����ͷ��̽�������С����������������()������������';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}

/*
Function name	:	isEmail
Parameter		:	str -> ��ͤ�������ͧ��õ�Ǩ�ͺ�ٻẺ�����
Description	:	��Ǩ�ͺ�ٻẺ������������ٻẺ������ʹ����������
Useage		:	if isEmail(EmailVariable)==true Then Email Format Else Email is not format End
*/
function 	isEmail(str) 
{
	var supported = 0;
	if (window.RegExp) {
		var tempStr = "a";
		var tempReg = new RegExp(tempStr);
		if (tempReg.test(tempStr)) supported = 1;
	}
	if (!supported) return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
	var r1 = new RegExp("(@.*@)|(\\.\\.)|(@\\.)|(^\\.)");
	var r2 = new RegExp("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$");
	return (!r1.test(str) && r2.test(str));
}

/*
Function name	:	ShowDataPicker
Paremeter		:	myDivName -> ���� Div �����ҧ�ԧ , RefX-> ���˹觢ͧ Div ���᡹ X, RefY-> ���˹觢ͧ Div ���᡹ Y
Description	:	�ʴ����ͧ��ͤ�����ҹ Tag Div (HTML) ������˹觷����ҧ�ԧ ** ����੾�� IE ���� Browser  ����� Component IE ��ҹ��
Useage		:	OnClick="ShowDataPicker('DivStatus',100,100)"
*/
var StatusIndex=0;
function 	ShowDataPicker(myDivName,RefX,RefY) 
{
	document.getElementById(myDivName).style.display=''; 
	document.getElementById(myDivName).style.left = document.body.scrollLeft + window.event.clientX + RefX;
	document.getElementById(myDivName).style.top= document.body.scrollTop+ window.event.clientY + RefY;
}

/*
Function name	:	Popup
Parameter		:	pname -> ���� Popup ,purl -> URL �����ҧ�ԧ, w -> �������ҧ�ͧ Popup , h-> �����٧�ͧ Popup, s -> ��/����� Schoolbar (1=Use,0=UnUse)
Description	:	�ʴ����ͧ Popup
Useage		:	OnClick="Popup('Popup1','../popup.php',150,150,1)"
*/
function 	Popup(pname,purl,w,h,s)
{
	LeftPosition = (screen.width) ? (screen.width-w-8)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h-50)/2 : 0;
	myWinName = window.open(purl,pname,"width="+w+",height="+h+",top="+TopPosition+",left="+LeftPosition+",resizable=no,status=1,z-lock=1,location=0,scrollbars="+s);
	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
	return myWinName;
}

/*
Function name	:	Popup
Parameter		:	pname -> ���� Popup ,purl -> URL �����ҧ�ԧ, w -> �������ҧ�ͧ Popup , h-> �����٧�ͧ Popup, s -> ��/����� Schoolbar (1=Use,0=UnUse)
Description	:	�ʴ����ͧ Popup
Useage		:	OnClick="Popup('Popup1','../popup.php',150,150,1)"
*/
function 	Popup2(pname,purl,w,h,s)
{
	LeftPosition = (screen.width) ? (screen.width-w-8)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h-50)/4 : 0;
	myWinName = window.open(purl,pname,"width="+w+",height="+h+",top="+TopPosition+",left="+LeftPosition+",resizable=no,scrollbars="+s);
	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
	return myWinName;
}

function currencyFormat2(number)
{
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var milSep=",";
	var decSep=".";
	//var whichCode = (window.Event) ? e.which : e.keyCode;
	//if (whichCode == 13) return true;  // Enter
	//key = String.fromCharCode(whichCode);  // Get key value from key code
	//if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
	if(number!='0.00')
	{
	len = number.length;
	for(i = 0; i < len; i++)
	{
		if ((number.charAt(i) != '0') && (number.charAt(i) != decSep)) break;
	}
	aux = '';
	for(; i < len; i++)
	{
		if (strCheck.indexOf(number.charAt(i))!=-1) aux += number.charAt(i);
	}
	aux += key;
	len = aux.length;
	if (len == 0) number = '';
	if (len == 1) number = '0'+ decSep + '0' + aux;
	if (len == 2) number = '0'+ decSep + aux;
	if (len > 2) 
	{
		aux2 = '';
		for (j = 0, i = len - 3; i >= 0; i--) 
		{
			if (j == 3) 
			{
				aux2 += milSep;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		number = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
		{
			number += aux2.charAt(i);
		}
		number += decSep + aux.substr(len - 2, len);
	}
	}
	return number;
}

function Currency2float(number)
{
	var len = number.length;
	var num = ''; 
	for(i=0;i<len;i++)
	{
		if(number.charAt(i)!=','){	num += number.charAt(i);}
	}
	return num;
}

/*
Function name	:	currencyFormat
Parameter		:	fld :-> Object ��ҧ�ԧ��Ŵ� text ����ͧ��õ�Ǩ�ͺ,e -> Event ��˹��˵ء�ó���ǹ�ҡ����Ѻ�˵ء�ûѨ�غѹ 
			:	miSep -> �ӹǹ��ѡ , decSep -> �ӹǹ�ȹ���
Description	:	�ʴ��ٻẺ������Ẻ����Թ㹢�з���͹�����ż�ҹ Text Field
Useage		:	-currencyFormat(this,2,2,evemt)
*/
function	currencyFormat(fld, milSep, decSep, e)
{
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	//if (whichCode == 13) return true;  // Enter
	key = String.fromCharCode(whichCode);  // Get key value from key code
	if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
	len = fld.value.length;
	for(i = 0; i < len; i++)
	{
		if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
	}
	aux = '';
	for(; i < len; i++)
	{
		if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
	}
	aux += key;
	len = aux.length;
	if (len == 0) fld.value = '';
	if (len == 1) fld.value = '0'+ decSep + '0' + aux;
	if (len == 2) fld.value = '0'+ decSep + aux;
	if (len > 2) 
	{
		aux2 = '';
		for (j = 0, i = len - 3; i >= 0; i--) 
		{
			if (j == 3) 
			{
				aux2 += milSep;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		fld.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
		{
			fld.value += aux2.charAt(i);
		}
		fld.value += decSep + aux.substr(len - 2, len);
	}
	return false;
}
/*
Function name : StripCode
Parameter	: str -> ��ͤ�������ͧ���᷹�������ͧ���� ' ���� \'
*/
function StripCode(str)
{
	var len = str.length;
	var string = ''; 
	for(i=0;i<len;i++)
	{
		if(str.charAt(i)=='\'')
		{
			string +="\'";	
		}else{
			string += str.charAt(i);
		}
	}
	return string;
}

/*
Function name	:	is_idcard
Parameter		:	id -> �����ŷ���ͧ��õ�Ǩ�ͺ�����Ţ�ѵû�Шӵ�ǻ�ЪҪ�
Description	:	��Ǩ�ͺ�����������Ţ�ѵû�Шӵ�ǻ�ЪҪ�
Useage		:	If is_idcard('3801600322589') Then Id Card Valid Else Id Card InVaid End
*/
function 	is_idcard(id)
{
	if(id.length != 13 ||  isNaN(id)  )
	{ 
		alert("�س��������ʺѵû�ЪҪ����ú������������Ţ");
		return false;
	}else{ 
		bit = new Array();
		formula_sum = 0; 
		for(i=0;i<13;i++)
		{ 
			bit[i] = id.substr(i,1); 
			if ( i < 12 )
			{ 
				formula_sum += bit[i] * ( 13 - i); 
			}
		} 
		formula_sum = formula_sum % 11; 
		if ( formula_sum == 0 )
		{
			formula_sum = 1;
		}else
		if ( formula_sum == 1 )
		{
			formula_sum = 0;
		}else{
			formula_sum = 11 -  formula_sum; 
		}
		if ( formula_sum !=  bit[12] ) 
		{ 
			alert("�س��������ʺѵû�ЪҪ��Դ");
			return false;
		}else{
			return true;
		} 
	} 
}

/*
Function name	:	Trim
Parameter		:	s -> ��ͤ�������ͧ��õѴ��ͧ��ҧ��ҹ������д�ҹ����͡
Description	:	�Ѵ��ͧ��ҧ�����ҧ��
Useage		:	String = Trim(String)
*/
function 	Trim(s) 
{
	while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
	{ 
		s = s.substring(1,s.length); 
	}
	while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
	{ 
		s = s.substring(0,s.length-1);
	}
	return s;
}

// check password
function passwordDecode(fld,e)
{

	var strCheck = '0123456789-_@abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.';
	var len = 0;
	var whichCode = (window.Event) ? e.which : e.keyCode;
	key = String.fromCharCode(whichCode); 
	if (strCheck.indexOf(key) == -1) return false;
}

/*
Function name	:	IsBlank
Parameter		:	ObjectString -> ���� Object Field ����ͧ��õ�Ǩ�ͺ
Description	:	��Ǩ�ͺ��ͧ��ҧ���� Object �����ҧ�ԧ
Useage		:	If IsBlank(ObectString) Then Return Null Else Return Not Null End
*/
function	IsBlank(ObjectString)
{
	var	ObjectTemp;
	ObjectTemp	=	Trim(ObjectString.value);
	if(ObjectTemp=='')
	{
		return true;
	}else{
		return false;
	}
}

/*
Function name	:	StrCmp
Parameter		:	String1 -> ��ͤ����ش��� 1 , String2 -> ��ͤ����ش��� 2
Description	:	���º��º��ͤ��� 2 �ش
Useage		:	If StrCmp(String1,String2) Then Equre Else Different End
*/
function	StrCmp(String1,String2)
{
	if(String1==String2)
	{
		return true;
	}else{
		return false;
	}
}
/*
Function name	:	CheckImageType
Parameter		:	myfiles -> ����������ͧ��õ�Ǩ�ͺ
Description	:	��Ǩ�ͺ������������͡��ҹ Object File ����繢������ٻ�Ҿ�������
Useage		:	If CheckImageType(ImageName) Then Image Format Else Not Image Format End
*/
function 	CheckImageType(myfiles)
{
	myfile=myfiles.value;
	myfile = myfile.toLowerCase();
	Temp = myfile.charAt(myfile.length-4) + myfile.charAt(myfile.length-3) + myfile.charAt(myfile.length-2) + myfile.charAt(myfile.length-1);
	if(Temp!='.jpg' && Temp!='.gif' && Temp!='jpeg') {
		alert('��س����͡�ٻ�Ҿ��ҹ��.');
		return false;
	}
	return true;
}
/*
Function name	:	Split2String
Parameter		:	Str -> �����ŷ���ͧ��õѴ��Ǩ�ͺ
Description		:	�Ѵ������Ẻ split
Useage			:	Split2String('31-1',1)
*/
function	Split2String(Str,fls)
{
	var temp=1;var strtemp=0;var temp1='';var temp2='';
	for(var i=0;i<Str.length;i++)
	{
		if(Str.charAt(i)=="-")
		{
			temp=2;
		}else{
			if(temp==1){temp1=temp1+(Str.charAt(i));}
			if(temp==2){temp2=temp2+Str.charAt(i);}
		}
	}
	if(fls==1){ var strtemp=temp1;}
	if(fls==2){ var strtemp=temp2;}
	return strtemp;
}

/*
Function name	:	Paging_CheckAll
Parameter		:	objCheckHeader -> ���� Object CheckBox ��ѡ�������ҧ�ԧ��ѧ Object CheckBox ��� �
			:	txtCheckBoxFirstName -> ���� Object CheckBox 
			:	intTotalItems -> �ӹǹ Object CheckBox 
Description	:	�ӡ�����͡/������͡ CheckBox �����ҧ�ԧ������
Useage		:	ONCLICK="Paging_CheckAll(document.myForm.CheckBoxAll,'CheckBoxID',document.myForm.TotalCheckBoxID.value)"
*/
function 	Paging_CheckAll(objCheckHeader,txtCheckBoxFirstName,intTotalItems) 
{
	if(intTotalItems>0)
	{
		for(i=1;i<=intTotalItems;i++)
		{
			if(document.getElementById(txtCheckBoxFirstName+i).checked){
			document.getElementById(txtCheckBoxFirstName+i).checked = false;//objCheckHeader.checked;
			}else{document.getElementById(txtCheckBoxFirstName+i).checked = true;}
		}
	}
	return true;
}

/*
Function name	:	Paging_CheckAllHandle
Parameter		:	objCheckHeader -> ���� Object CheckBox ��ѡ�������ҧ�ԧ��ѧ Object CheckBox ��� �
			:	txtCheckBoxFirstName -> ���� Object CheckBox 
			:	intTotalItems -> �ӹǹ Object CheckBox 
Description	:	�ӡ�ä�ԡ���͡ CheckBox �����ѡ����ͷӡ�����͡��������������
Useage		:	ONCLICK="Paging_CheckAllHandle(document.myForm.CheckBoxAll,'CheckBoxID',document.myForm.TotalCheckBoxID.value)
*/
function 	Paging_CheckAllHandle(objCheckHeader,txtCheckBoxFirstName,intTotalItems) 
{
	var isCheckedAll = true;
	if(intTotalItems>0)
	{
		for(i=1;i<=intTotalItems;i++)
		{
			if(!document.getElementById(txtCheckBoxFirstName+i).checked) 
			{
				isCheckedAll = false;
			}
		}
	}
	objCheckHeader.checked = isCheckedAll;
	return true;
}

/*
Function name	:	Paging_CountChecked
Parameter		:	txtCheckBoxFirstName -> ���� Object CheckBox , intTotalItems -> �ӹǹ Object CheckBox 
Description	:	��Ǩ�ͺ CheckBox ������͡
Useage		:	if(Paging_CountChecked('CheckBoxID',document.myForm.TotalCheckBoxID.value)==1) 
*/
function 	Paging_CountChecked(txtCheckBoxFirstName,intTotalItems) 
{
	var intChecked = 0;
	if(intTotalItems>0)
	{
		for(i=1;i<=intTotalItems;i++)
		{
			if(document.getElementById(txtCheckBoxFirstName+i)!=null)
			{
				if(document.getElementById(txtCheckBoxFirstName+i).checked) 
				{
					intChecked ++;
				}
			}
		}
	}
	return intChecked ;
}

/*
Function name	:	Paging_CheckedThisItem
Parameter		:	objCheckHeader -> ���� Object CheckBox ��ѡ�������ҧ�ԧ��ѧ Object CheckBox ��� �
			:	indexing -> ���˹觢ͧ CheckBox ����ͧ������͡
			:	txtCheckBoxFirstName -> ���� Object CheckBox 
			:	intTotalItems -> �ӹǹ Object CheckBox 
Description	:	���͡ CheckBox �����ҧ�ԧ������˹� Index ����ͧ���
Useage		:	Paging_CheckedThisItem(document.myForm.CheckBoxAll, StatusIndex ,'CheckBoxID', document.myForm.TotalCheckBoxID.value );
*/
function 	Paging_CheckedThisItem(objCheckHeader,indexing,txtCheckBoxFirstName,intTotalItems) 
{
	if(intTotalItems>0)
	{
		for(i=1;i<=intTotalItems;i++)
		{
			if(i==indexing) {
				document.getElementById(txtCheckBoxFirstName+i).checked = true;
			} else {
				document.getElementById(txtCheckBoxFirstName+i).checked = false;
			}
		}
	}
	objCheckHeader.checked = false;
	return true;
}

/*
Function name	:	funcMultipleSelectAll
Parameter		:	myListObj -> ���� Object Select �����ҧ�ԧ
Description	:	���͡ Option ���� Select Object Ẻ Multi list �ء � Option
Useage		:	OnClick="funcMultipleSelectAll('SelectMulti')"
*/
function 	funcMultipleSelectAll(myListObj) 
{
	var myListObj = document.getElementById(myListObj);
	var Len = myListObj.options.length;
	if(Len>0) 
	{
		for(var i=0;i<Len;i++)
		{
			myListObj.options[i].selected=true;
		}
	}
}

/*
Function name	:	funcMultipleMoveUp
Parameter		:	myListObj -> ���� Object Select �����ҧ�ԧ
Description	:	���͡ Option ���� Select Object Ẻ Multi list ��� 1 ���˹�
Useage		:	OnClick="funcMultipleMoveUp('SelectMulti')"
*/
function 	funcMultipleMoveUp(myListObj)
{
	var myListObj = document.getElementById(myListObj);
	var Len = myListObj.options.length;
	var tmpID,tmpValue;
	if(Len>0)
	{
		for(var i=1;i<Len;i++)
		{
			if (myListObj.options[i]!=null && myListObj.options[i].selected==true)
			{
				if(!myListObj.options[i-1].selected)
				{
					myListObj.options[i].selected=false;
					tmpID = myListObj.options[i].value;
					tmpValue = myListObj.options[i].text;
					myListObj.options[i].value = myListObj.options[i-1].value;
					myListObj.options[i].text = myListObj.options[i-1].text;
					myListObj.options[i-1].value = tmpID;
					myListObj.options[i-1].text = tmpValue;
					myListObj.options[i-1].selected=true;
				}
			}
		}
	}
}

/*
Function name	:	funcMultipleMoveDown
Parameter		:	myListObj -> ���� Object Select �����ҧ�ԧ
Description	:	���͡ Option ���� Select Object Ẻ Multi list ŧ 1 ���˹�
Useage		:	OnClick="funcMultipleMoveDown('SelectMulti')"
*/
function funcMultipleMoveDown(myListObj)
{
	var myListObj = document.getElementById(myListObj);
	var Len = myListObj.options.length;
	var tmpID,tmpValue;
	if(Len>0)
	{
		for(var i=Len-2;i>=0;i--)
		{
			if (myListObj.options[i]!=null && myListObj.options[i].selected==true)
			{
				if(!myListObj.options[i+1].selected)
				{
					myListObj.options[i].selected=false;
					tmpID = myListObj.options[i].value;
					tmpValue = myListObj.options[i].text;
					myListObj.options[i].value = myListObj.options[i+1].value;
					myListObj.options[i].text = myListObj.options[i+1].text;
					myListObj.options[i+1].value = tmpID;
					myListObj.options[i+1].text = tmpValue;
					myListObj.options[i+1].selected=true;
				}
			}
		}
	}
}

function hideSelects(action) {
//documentation for this script at http://www.shawnolson.net/a/1198/
//possible values for action are 'hidden' and 'visible'
if (action!='visible'){action='hidden';}
if (navigator.appName.indexOf("MSIE")) {
for (var S = 0; S < document.forms.length; S++){
for (var R = 0; R < document.forms[S].length; R++) {
if (document.forms[S].elements[R].options) {
document.forms[S].elements[R].style.visibility = action;
}
}
} 
}
}

//-----------------------------------------------------------------------------------------------------//
// ��������ҧ�ԧcheckbox
//-----------------------------------------------------------------------------------------------------//
function GetCheckBoxIDFOpener()
{
	var TotalCheckBoxID = window.opener.document.getElementById('TotalCheckBoxID').value;
	for(var i=1;i<=TotalCheckBoxID;i++)
	{
		if(window.opener.document.getElementById('CheckBoxID'+i).checked)
		{
			window.opener.document.getElementById('CheckBoxID'+i).checked=false;
			return window.opener.document.getElementById('CheckBoxID'+i).value;
		}
	}
}



function formatCurrency(num) {
num = num.toString().replace(/\$|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+','+
num.substring(num.length-(4*i+3));
return (((sign)?'':'-') + '$' + num + '.' + cents);
}

function CalCulatorFormat(num)
{
	var number=0;
	number=eval(num);
	return number.toFixed(2);
}
   function blinkIt() {
      if (!document.all) return;
      else {
      for(i=0;i<document.all.tags('blink').length;i++){
       s=document.all.tags('blink')[i];
       //s.style.visibility=(s.style.visibility=='visible')?'hidden':'visible';
	   s.className=(s.className=='topshortcut')?'topshortcut1':'topshortcut';
      }
   }
   id = setTimeout("blinkIt()",500);
 }
 
 /*
 
 */
 function BookingMarkSetAlert_New()
{
	window.opener.top.frames['WKTop'].document.getElementById('booking_new_text').innerHTML='New&nbsp;Booking';
	window.opener.top.frames['WKTop'].document.getElementById('booking_new_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('booking_new_image_normal').style.display='';
}

function BookingMarkSetAlert_Modify()
{
	window.opener.top.frames['WKTop'].document.getElementById('booking_modify_text').innerHTML='Modify';
	window.opener.top.frames['WKTop'].document.getElementById('booking_modify_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('booking_modify_image_normal').style.display='';
}

function BookingMarkSetAlert_Cancell()
{
	window.opener.top.frames['WKTop'].document.getElementById('booking_cancel_text').innerHTML='Cancel';
	window.opener.top.frames['WKTop'].document.getElementById('booking_cancel_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('booking_cancel_image_normal').style.display='';
}

function BookingMarkSetAlert_Wait()
{
	window.opener.top.frames['WKTop'].document.getElementById('booking_wait_text').innerHTML='Waiting';
	window.opener.top.frames['WKTop'].document.getElementById('booking_waiting_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('booking_waiting_image_normal').style.display='';
}

function BookingMarkSetAlert_Avail()
{
	window.opener.top.frames['WKTop'].document.getElementById('roomavail_text').innerHTML='Room&nbsp;Avail';
	window.opener.top.frames['WKTop'].document.getElementById('roomavail_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('roomavail_image_normal').style.display='';
}

function BookingMarkSetAlert_Summary()
{
	window.opener.top.frames['WKTop'].document.getElementById('ratesummary_text').innerHTML='Rate&nbsp;Summary';
	window.opener.top.frames['WKTop'].document.getElementById('ratesummary_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('ratesummary_image_normal').style.display='';
}

function BookingMarkSetAlert_Agency()
{
	window.opener.top.frames['WKTop'].document.getElementById('agency_text').innerHTML='Agency';
	window.opener.top.frames['WKTop'].document.getElementById('agency_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('agency_image_normal').style.display='';
}

function BookingMarkSetAlert_Coporate()
{
	window.opener.top.frames['WKTop'].document.getElementById('coporate_text').innerHTML='Coporate';
	window.opener.top.frames['WKTop'].document.getElementById('coporate_image_active').style.display='none';
	window.opener.top.frames['WKTop'].document.getElementById('coporate_image_normal').style.display='';
}