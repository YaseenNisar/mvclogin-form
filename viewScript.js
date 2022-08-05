const registerLi=document.querySelector('.register-li')
const loginLi=document.querySelector('.login-li')

const registerSection=document.querySelector('.register-section')
const loginSection=document.querySelector('.login-section')
const messageSection=document.querySelector('.message-section')
const loginSubmit=document.querySelector('.login-submit')
const registerSubmit=document.querySelector('.register-submit')
const registerForm= document.querySelector('.register-form')
const loginForm= document.querySelector('.login-form')

registerLi.addEventListener('click',()=>{

loginSection.style.display="none";
messageSection.style.display="none";
registerSection.style.display="block";
})


loginLi.addEventListener('click',()=>{

loginSection.style.display="block";
messageSection.style.display="none";
registerSection.style.display="none";
})

registerSubmit.addEventListener('click',(e)=>{

	 e.preventDefault() 
	 fetch('/controller.php' , {
	 	method:'POST',
	 	body: new FormData(registerForm)
	 })

.then(res=>res.json())
.then(data=>{
	 loginSection.style.display="none"
	 registerSection.style.display="none"
	 messageSection.style.display="block"
	 messageSection.innerHTML='
	 <p>${data.status}</p>
	 '

})
})



loginSubmit.addEventListener('click',(e)=>{

	 e.preventDefault() 
	 fetch('/controller.php' , {
	 	method:'POST',
	 	body: new FormData(loginForm)
	 })

.then(res=>res.json())
.then(data=>{
	 loginSection.style.display="none"
	 registerSection.style.display="none"
	 messageSection.style.display="block"
	 messageSection.innerHTML='
	 <p>${data.status}</p>
	 '
	 
})
})