const formHelper = formId => {
    const inputFieldClassName = '.form-control'; 
    let toggleBtn, formRest;
    let formEl = document.querySelector(`#${formId}`);
    const errorEls = document.querySelectorAll(`#${formId} [data-error]`);

    let clearErrorMessages = () => {
        errorEls.forEach(el => el.innerHTML = '');
    }
    
    let getFormData = () => {
        let data = {};
        document.querySelectorAll(`#${formId} ${inputFieldClassName}`).forEach(inputEl => data[inputEl.name] = inputEl.value);
        return data;
    }

    let formEditState = (toggleBtnId) => {
        toggleBtn = document.getElementById(toggleBtnId);
        const fields = formEl.querySelectorAll(`input,select,${inputFieldClassName}`);
        let creaetState = (initFun = () => {}) => {
            clearErrorMessages();
            formRest();
            formEl.dataset.formType = "create";
            toggleBtn.parentNode.style.visibility = 'hidden';
            changeInputAccess(false);
            toggleBtn.checked = false;
            initFun();
        };
        let updateState = (initFun = () => {}) => {
            clearErrorMessages();
            formEl.dataset.formType = "update";
            toggleBtn.checked = false;
            changeInputAccess(true);
            toggleBtn.parentNode.style.visibility = 'visible';
            initFun();
        };

        let changeInputAccess = (access) => {
             fields.forEach(field => {
                field.disabled = access;
            });
        }

        toggleBtn.addEventListener('click', (e) => {
           changeInputAccess(!e.target.checked);
        });
        return {creaetState, updateState, toggleBtn};
    } 
    
    let ajaxError = () => {
        return (err) => {
            if (err.status == 422) {
                let errors = {};
                if (err.responseText) {
                    errors = JSON.parse(err.responseText)?.errors;
                }
                for(let field in errors){
                    let errorEl = document.querySelector(`#${formId} [data-error='${field}']`);
                    errorEl.innerText = errors[field][0];
                 }
            }
        }
    }

    formRest = () => formEl.reset(); 

    return {
        clearErrorMessages,
        getFormData, 
        ajaxError,
        formEl,
        formRest,
        formEditState,
    }
}



// Swal.fire({
//     title: "Auto close alert!",
//     html: "I wil+l close in <strong></strong> seconds.",
//     timer: 2e3,
//     html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Aww yeah, you successfully read this important message.</p></div></div>',
//     showCancelButton: !0,
//     showConfirmButton: !1,
//     cancelButtonClass: "btn btn-primary w-xs mb-1",
//     cancelButtonText: "Back",
//     buttonsStyling: !1,
//     showCloseButton: !0,
//     // timerProgressBar: !0,
//     showCloseButton: !0,
//     didOpen: function () {
//         Swal.showLoading(),
//             (t = setInterval(function () {
//                 var t = Swal.getHtmlContainer();
//                 t &&
//                     (t = t.querySelector("b")) &&
//                     (t.textContent = Swal.getTimerLeft());
//             }, 100));
//     },
//     onClose: function () {
//         clearInterval(t);
//     },
// }).then(function (t) {
//     t.dismiss === Swal.DismissReason.timer 
// });



