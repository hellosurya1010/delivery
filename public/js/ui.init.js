const formHelper = (formId = "No-form") => {
    const inputFieldClassName = ".form-control";
    let toggleBtn, formRest;
    let formEl = document.querySelector(`#${formId}`);
    const errorEls = document.querySelectorAll(`#${formId} [data-error]`);

    let clearErrorMessages = () => {
        errorEls.forEach((el) => (el.innerHTML = ""));
    };

    let getFormData = () => {
        let data = {};
        document
            .querySelectorAll(`#${formId} ${inputFieldClassName}`)
            .forEach((inputEl) => (data[inputEl.name] = inputEl.value));
        return data;
    };

    const imgPreview = ({inputFileId, imageElId}) => {
        let fileEl = document.querySelector(`#${inputFileId}`);
        let imgEl = document.querySelector(`#${imageElId}`);
        fileEl.addEventListener("change", function () {
            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function () {
                imgEl.src = reader.result;
            });
            reader.readAsDataURL(file);
        });
    };

    let formState = () => {
        const fields = formEl.querySelectorAll(
            `input,select,${inputFieldClassName}`
        );
        let creaetState = ({ before = () => {}, after = () => {} }) => {
            before();
            clearErrorMessages();
            formRest();
            formEl.dataset.formType = "create";
            if (toggleBtn) {
                toggleBtn.parentNode.style.visibility = "hidden";
                toggleBtn.checked = false;
            }
            changeInputAccess(false);
            after();
        };
        let updateState = ({ before = () => {}, after = () => {} }) => {
            before();
            clearErrorMessages();
            formEl.dataset.formType = "update";
            changeInputAccess(true);
            if (toggleBtn) {
                toggleBtn.checked = false;
                toggleBtn.parentNode.style.visibility = "visible";
            }
            after();
        };

        let changeInputAccess = (access) => {
            fields.forEach((field) => {
                field.disabled = access;
            });
        };

        let stateToggler = (toggleBtnId) => {
            toggleBtn = document.getElementById(toggleBtnId);
            toggleBtn.addEventListener("click", (e) => {
                changeInputAccess(!e.target.checked);
            });
        };

        return { creaetState, updateState, toggleBtn, stateToggler };
    };

    let ajaxError = () => {
        return (err) => {
            let status = err.status;
            if (status == 422) {
                let errors = {};
                if (err.responseText) {
                    errors = JSON.parse(err.responseText)?.errors;
                }
                for (let field in errors) {
                    let errorEl = document.querySelector(
                        `#${formId} [data-error='${field}']`
                    );
                    errorEl.innerText = errors[field][0];
                }
            } else if (status == 500) {
                SwalModal({ type: "error", title: "Sever error!" });
            } else {
                SwalModal({
                    type: "error",
                    title: `Sever error!`,
                    message: `status code: ${status}`,
                });
            }
        };
    };

    formRest = () => formEl.reset();

    return {
        clearErrorMessages,
        getFormData,
        ajaxError,
        formEl,
        formRest,
        formState,
    };
};

php;
$(document).ready(function () {
    $(".single-select2").each(function () {
        console.log($(this));
    });
});

const SwalModal = ({
    timer = 2500,
    type = "success",
    title = "",
    message = "",
}) => {
    // const { timer, type, title, message } = settings;
    const images = {
        success: {
            url: "https://cdn.lordicon.com/lupuorrc.json",
            clr: ["#0ab39c", "#405189"],
        },
        error: {
            url: "https://cdn.lordicon.com/tdrtiskw.json",
            clr: ["#f06548", "#f7b84b"],
        },
    };
    let { url, clr } = images[type];
    let html = `<div class="mt-3">
        <lord-icon
            src="${url}"
            trigger="loop"
            colors="primary:${clr[0]},secondary:${clr[1]}"
            style="width:120px;height:120px"
        ></lord-icon>
        <div class="mt-4 pt-2 fs-15">
            <h4>${title}</h4>
            <p class="text-muted mx-4 mb-0">${message}</p>
        </div>
    </div>`;
    Swal.fire({
        html,
        showCancelButton: !0,
        showConfirmButton: !1,
        timer,
        cancelButtonClass: "btn btn-primary w-xs mb-1",
        cancelButtonText: "Back",
        buttonsStyling: !1,
        showCloseButton: !0,
    });
};
