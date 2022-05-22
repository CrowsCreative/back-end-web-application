DOM = {
    passwForm: '.password-strength',
    passwErrorMsg: '.password-strength__error',
    passwInput: document.querySelector('.password-strength__input'),
    passwVisibilityBtn: '.password-strength__visibility',
    passwVisibility_icon: '.password-strength__visibility-icon',
    passwVisibilityBtn2: '.password-strength__visibility_2',
    passwVisibility_icon2: '.password-strength__visibility-icon_2',
    strengthBar: document.querySelector('.password-strength__bar'),
    submitBtn: document.querySelector('.password-strength__submit'),
    form: document.querySelector('form'),
    passwordConfirme: document.querySelector(".password")};
    

  
  //*** HELPERS
  let a, b, c,
      submitContent,
      captcha,
      locked,
      timeoutHandle;
  let validePassword = false;
  let validSubmit = false;
  //need to append classname with '.' symbol
  const findParentNode = (elem, parentClass) => {
  
    parentClass = parentClass.slice(1, parentClass.length);
  
    while (true) {
  
      if (!elem.classList.contains(parentClass)) {
        elem = elem.parentNode;
      } else {
        return elem;
      }
  
    }
  
  };
  
  //*** MAIN CODE
  
  const getPasswordVal = input => {
    return input.value;
  };
  
  const testPasswRegexp = (passw, regexp) => {
  
    return regexp.test(passw);
  
  };
  
  const testPassw = passw => {
  
    let strength = 'none';
  
    const moderate = /(?=.*[A-Z])(?=.*[a-z]).{5,}|(?=.*[\d])(?=.*[a-z]).{5,}|(?=.*[\d])(?=.*[A-Z])(?=.*[a-z]).{5,}/g;
    const strong = /(?=.*[A-Z])(?=.*[a-z])(?=.*[\d]).{7,}|(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=.*[\d]).{7,}/g;
    const extraStrong = /(?=.*[A-Z])(?=.*[a-z])(?=.*[\d])(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?]).{9,}/g;
  
    if (testPasswRegexp(passw, extraStrong)) {
      strength = 'extra';
    } else if (testPasswRegexp(passw, strong)) {
      strength = 'strong';
    } else if (testPasswRegexp(passw, moderate)) {
      strength = 'moderate';
    } else if (passw.length > 0) {
      strength = 'weak';
    }
  
    return strength;
  
  };
  
  const testPasswError = passw => {
  
    const errorSymbols = /\s/g;
  
    return testPasswRegexp(passw, errorSymbols);
  
  };
  
  const setStrengthBarValue = (bar, strength) => {
  
    let strengthValue;
  
    switch (strength) {
      case 'weak':
        strengthValue = 25;
        bar.setAttribute('aria-valuenow', strengthValue);
        break;
  
      case 'moderate':
        strengthValue = 50;
        bar.setAttribute('aria-valuenow', strengthValue);
        break;
  
      case 'strong':
        strengthValue = 75;
        bar.setAttribute('aria-valuenow', strengthValue);
        break;
  
      case 'extra':
        strengthValue = 100;
        bar.setAttribute('aria-valuenow', strengthValue);
        break;
  
      default:
        strengthValue = 0;
        bar.setAttribute('aria-valuenow', 0);}
  
  
    return strengthValue;
  
  };
  
  //also adds a text label based on styles
  const setStrengthBarStyles = (bar, strengthValue) => {
  
    bar.style.width = `${strengthValue}%`;
  
    bar.classList.remove('bg-success', 'bg-info', 'bg-warning');
  
    switch (strengthValue) {
      case 25:
        bar.classList.add('bg-danger');
        bar.textContent = 'Faible';
        break;
  
      case 50:
        bar.classList.remove('bg-danger');
        bar.classList.add('bg-warning');
        bar.textContent = 'Moyen';
        break;
  
      case 75:
        bar.classList.remove('bg-danger');
        bar.classList.add('bg-info');
        bar.textContent = 'Puissant';
        break;
  
      case 100:
        bar.classList.remove('bg-danger');
        bar.classList.add('bg-success');
        bar.textContent = 'Excelent';
        break;
  
      default:
        bar.classList.add('bg-danger');
        bar.textContent = '';
        bar.style.width = `0`;}
  
  
  };
  
  const setStrengthBar = (bar, strength) => {
  
    //setting value
    const strengthValue = setStrengthBarValue(bar, strength);
  
    //setting styles
    setStrengthBarStyles(bar, strengthValue);
  };
  
  const unblockSubmitBtn = (btn, strength, validePassword, validSubmit) => {
    console.log(strength, validePassword, validSubmit)
    if (strength === 'none' || strength === 'strong' || !validePassword || !validSubmit) {
      console.log("DISABLE")
      btn.disabled = true;
    } else {
      console.log("ENABLE")
      btn.disabled = false;
    }
  
  };
  
  const findErrorMsg = input => {
    const passwForm = findParentNode(input, DOM.passwForm);
    return passwForm.querySelector(DOM.passwErrorMsg);
  };
  
  const showErrorMsg = input => {
    const errorMsg = findErrorMsg(input);
    errorMsg.classList.remove('js-hidden');
  };
  
  const hideErrorMsg = input => {
    const errorMsg = findErrorMsg(input);
    errorMsg.classList.add('js-hidden');
  };
  
  const passwordStrength = (input, strengthBar, btn, validePassword, validSubmit) => {
  
    //getting password
    const passw = getPasswordVal(input);
  
    //check if there is an error
    const error = testPasswError(passw);
  
    if (error) {
  
      showErrorMsg(input);
  
    } else {
  
      //hide error messages
      hideErrorMsg(input);
  
      //finding strength
      const strength = testPassw(passw);
  
      //setting strength bar (value and styles)
      setStrengthBar(strengthBar, strength);
  
      //unblock submit btn only if password is moderate or stronger
      unblockSubmitBtn(btn, strength, validePassword, validSubmit);
    }
  
  };
  
  const passwordVisible = passwField => {
  
    const passwType = passwField.getAttribute('type');
  
    let visibilityStatus;
  
    if (passwType === 'text') {
  
      passwField.setAttribute('type', 'password');
  
      visibilityStatus = 'hidden';
  
    } else {
  
      passwField.setAttribute('type', 'text');
  
      visibilityStatus = 'visible';
  
    }
  
    return visibilityStatus;
  
  };
  
  const changeVisibiltyBtnIcon = (btn, status) => {
  
    const hiddenPasswIcon = btn.querySelector(`${DOM.passwVisibility_icon}[data-visible="hidden"]`);
    const visibilePasswIcon = btn.querySelector(`${DOM.passwVisibility_icon}[data-visible="visible"]`);
    const hiddenPasswIcon2 = btn.querySelector(`${DOM.passwVisibility_icon2}[data-visible="hidden"]`);
    const visibilePasswIcon2 = btn.querySelector(`${DOM.passwVisibility_icon2}[data-visible="visible"]`);

    if (status === 'visible') {
      visibilePasswIcon.classList.remove('js-hidden');
      hiddenPasswIcon.classList.add('js-hidden');
      visibilePasswIcon2.classList.remove('js-hidden');
      hiddenPasswIcon2.classList.add('js-hidden');
    } else if (status === 'hidden') {
      visibilePasswIcon.classList.add('js-hidden');
      hiddenPasswIcon.classList.remove('js-hidden');
      visibilePasswIcon2.classList.add('js-hidden');
      hiddenPasswIcon2.classList.remove('js-hidden');
    }
  
  };
  
  const passwVisibilitySwitcher = (passwField, visibilityToggler) => {
  
    const visibilityStatus = passwordVisible(passwField);
  
    changeVisibiltyBtnIcon(visibilityToggler, visibilityStatus);
  };
  
  //next()
  
  //donext()
  
  //*** EVENT LISTENERS
  
  DOM.passwordConfirme.addEventListener("keyup", (e)=>
  {
      if(e.target.value === getPasswordVal(DOM.passwInput))
      {
          e.target.classList.add("success");
          e.target.classList.remove("error");
          validePassword = true;
          passwordStrength(DOM.passwInput, DOM.strengthBar, DOM.submitBtn, validePassword, validSubmit);
      }else
      {
        e.target.classList.add("error");
        e.target.classList.remove("success");
        validePassword = false;
        passwordStrength(DOM.passwInput, DOM.strengthBar, DOM.submitBtn, validePassword, validSubmit);
      }
  
  });
  
  DOM.passwInput.addEventListener('input', () => {
    
        passwordStrength(DOM.passwInput, DOM.strengthBar, DOM.submitBtn, validePassword, validSubmit);
  });
  
  const passwVisibilityBtn = document.querySelector(DOM.passwVisibilityBtn);
  const passwVisibilityBtn2 =  document.querySelector(DOM.passwVisibilityBtn2);
  passwVisibilityBtn.addEventListener('click', e => {
  
    let toggler = findParentNode(e.target, DOM.passwVisibilityBtn);
  
    passwVisibilitySwitcher(DOM.passwInput, toggler);
  
  });
  
  passwVisibilityBtn2.addEventListener('click', e => {
  
    let toggler = findParentNode(e.target, DOM.passwVisibilityBtn2);
  
    passwVisibilitySwitcher(DOM.passwordConfirme, toggler);
  
  });
  
  
  
    // Generating a simple sum (a + b) to make with a result (c)
  function generateCaptcha(){
    a = Math.ceil(Math.random() * 10);
    b = Math.ceil(Math.random() * 10);
    c = a + b;
    submitContent = '<span>' + a + '</span> + <span>' + b + '</span>' +
      ' = <input class="submit__input" type="text" maxlength="2" size="2" required />';
    $('.submit__generated').html(submitContent);
  
    init();
  }
  
  
  // Check the value 'c' and the input value.
  function checkCaptcha(){
    if(captcha === c){
      // Pop the green valid icon
      $('.submit__generated')
        .removeClass('unvalid')
        .addClass('valid');
      $('.submit').removeClass('overlay');
      $('.submit__overlay').fadeOut('fast');
  
      $('.submit__error').addClass('hide');
      $('.submit__error--empty').addClass('hide');
      validSubmit = true;
      passwordStrength(DOM.passwInput, DOM.strengthBar, DOM.submitBtn, validePassword, validSubmit);
    }
    else {
      if(captcha === ''){
        $('.submit__error').addClass('hide');
        $('.submit__error--empty').removeClass('hide');
      }
      else {
        $('.submit__error').removeClass('hide');
        $('.submit__error--empty').addClass('hide');
      }
      // Pop the red unvalid icon
      $('.submit__generated')
        .removeClass('valid')
        .addClass('unvalid');
      $('.submit').addClass('overlay');
      $('.submit__overlay').fadeIn('fast');
      validSubmit = false;
      passwordStrength(DOM.passwInput, DOM.strengthBar, DOM.submitBtn, validePassword, validSubmit);
    }
    //return validSubmit;
  }
  
  function unlock(){ locked = false; }
  
  
  // Refresh button click - Reset the captcha
  $('.submit__control i.fa-sync').on('click', function(){
    if (!locked) {
      locked = true;
      setTimeout(unlock, 500);
      generateCaptcha();
      setTimeout(checkCaptcha, 0);
    }
  });
  
  
  // init the action handlers - mostly useful when 'c' is refreshed
  function init(){
    $('form').on('submit', function(e){
      
      if($('.submit__generated').hasClass('valid')){
        // var formValues = [];
        captcha = $('.submit__input').val();
        if(captcha !== ''){
          captcha = Number(captcha);
        }
  
        checkCaptcha();
  
        if(validSubmit === true){
          validSubmit = false;
          // Temporary direct 'success' simulation
          submitted();
        }
      }
      else {
        return false;
      }
    });
  
  
    // Captcha input result handler
    $('.submit__input').on('propertychange change keyup input paste', function(){
      // Prevent the execution on the first number of the string if it's a 'multiple number string'
      // (i.e: execution on the '1' of '12')
      window.clearTimeout(timeoutHandle);
      timeoutHandle = window.setTimeout(function(){
        captcha = $('.submit__input').val();
        if(captcha !== ''){
          captcha = Number(captcha);
        }
        checkCaptcha();
      },150);
    });
  
  
    // Add the ':active' state CSS when 'enter' is pressed
    $('body')
      .on('keydown', function(e) {
        if (e.which === 13) {
          if($('.submit-form').hasClass('overlay')){
            checkCaptcha();
          } else {
            $('.submit-form').addClass('enter-press');
          }
        }
      })
      .on('keyup', function(e){
        if (e.which === 13) {
          $('.submit-form').removeClass('enter-press');
        }
      });
  
  
    // Refresh button click - Reset the captcha
    $('.submit-control i.fa-refresh').on('click', function(){
      if (!locked) {
        locked = true;
        setTimeout(unlock, 500);
        generateCaptcha();
        setTimeout(checkCaptcha, 0);
      }
    });
  
  
    // Submit white overlay click
    $('.submit-form-overlay').on('click', function(){
      checkCaptcha();
    });
  }
  
  generateCaptcha();
  
  