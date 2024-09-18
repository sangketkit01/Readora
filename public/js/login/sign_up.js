let password = document.getElementById("password-input")
let confirmPassword = document.getElementById("confirm-password-input")
let passwordP = document.getElementById("password-p")
let confirmPasswordP = document.getElementById("confirm-p")

password.addEventListener("input", () => {
    if (password.value.length < 8) {
        if (passwordP.classList.contains("text-success")) {
            passwordP.classList.remove("text-success");
        }

        passwordP.classList.add("text-danger");
    } else {
        if (passwordP.classList.contains("text-danger")) {
            passwordP.classList.remove("text-danger");
        }

        passwordP.classList.add("text-success");
    }
});

confirmPassword.addEventListener("input" , () =>{
    if(confirmPassword.value !== password.value){
        if(confirmPasswordP.classList.contains("text-success")){
            confirmPasswordP.classList.remove("text-success")
        }

        confirmPasswordP.classList.add("text-danger")
    }else{
        if(confirmPasswordP.classList.contains("text-danger")){
            confirmPasswordP.classList.remove("text-danger")
        }

        confirmPasswordP.classList.add("text-success")
    }
})