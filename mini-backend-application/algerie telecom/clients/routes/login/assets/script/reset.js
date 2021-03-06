DOM = {
    passwForm: '.password-strength',
    passwErrorMsg: '.password-strength__error',
    passwInput: document.querySelector('.password-strength__input'),
    passwVisibilityBtn: '.password-strength__visibility',
    passwVisibility_icon: '.password-strength__visibility-icon',
    strengthBar: document.querySelector('.password-strength__bar'),
    submitBtn: document.querySelector('.password-strength__submit') };
  
  
  //*** HELPERS
  let a, b, c,
      submitContent,
      captcha,
      locked,
      timeoutHandle;
  const form = document.querySelector('form');
  const input = document.querySelector(".sign-up");
  const pattern = /^0[0-9]{8}$/;
  let valideUsername = false;
  let validSubmit = false;

  
  const unblockSubmitBtn = (btn,valideUsername, validSubmit) => {
    console.log(valideUsername, validSubmit)
    if (!valideUsername || !validSubmit) {
      console.log("DISABLE")
      btn.disabled = true;
    } else {
      console.log("ENABLE")
      btn.disabled = false;
    }
  
  };
  
  
  //*** EVENT LISTENERS
  
  input.addEventListener("keyup", (e)=>
  {
      if(pattern.test(e.target.value))
      {
          e.target.classList.add("success");
          e.target.classList.remove("error");
          valideUsername = true;
          unblockSubmitBtn(DOM.submitBtn,valideUsername, validSubmit);
          
      }else
      {
        e.target.classList.add("error");
        e.target.classList.remove("success");
        valideUsername = false;
        unblockSubmitBtn(DOM.submitBtn,valideUsername, validSubmit);
      }
  
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
      unblockSubmitBtn(DOM.submitBtn,valideUsername, validSubmit);
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
      unblockSubmitBtn(DOM.submitBtn,valideUsername, validSubmit);
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
  
  