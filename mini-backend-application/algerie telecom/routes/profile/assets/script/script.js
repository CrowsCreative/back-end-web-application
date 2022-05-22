// circular buttons

    document.querySelector('#f1').addEventListener('click', ()=>
    {
        document.getElementById('circularMenu').classList.toggle('active');
    })

    document.querySelector('#f2').addEventListener('click', ()=>
    {
        document.getElementById('circularMenu1').classList.toggle('active');
    })

// show image
    function showImage()
        {
            if(this.files && this.files[0])
            {
        
        
        
            //let FileReader = require('filereader');
            let obj = new FileReader();
            obj.onload = function(data)
            {
                let image = document.querySelector('#profile-picture');
                image.src = data.target.result;
                image.style.display = "block";
            }
            obj.readAsDataURL(this.files[0]);
            }
        
        
        
        }

        function showPictureMedium()
        {
            if(this.files && this.files[0])
            {
        
        
        
            //let FileReader = require('filereader');
            let obj = new FileReader();
            obj.onload = function(data)
            {
                let image = document.querySelector('#ppmd');
                image.src = data.target.result;
                image.style.display = "block";
            }
            obj.readAsDataURL(this.files[0]);
            }
        
        
        
        }
        
// page pre-loader
      jQuery(document).ready(function ($) {
        'use strict';
        $(window).load(function () {
          $('#preloader').fadeOut('slow', function () {
            $(this).remove();
          });
        });
      });

      const clock = document.querySelector('.clock');
      const date = document.querySelector('.date');
      const tick = ()=>
      {
          const now = new Date();
          const temp =
          `
          <span>${now.getHours()}</span> :
          <span>${now.getMinutes()}</span> :
          <span>${now.getSeconds()}</span>
      
          `;
      
          date.innerHTML = now.toDateString();
          clock.innerHTML = temp;
          
      }
      
      setInterval(tick, 1000);

//inderactive calendar
'use strict';

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

let Heading = function Heading(_ref) {
  let date = _ref.date;
  let changeMonth = _ref.changeMonth;
  let resetDate = _ref.resetDate;
  return React.createElement(
    'nav',
    { className: 'calendar--nav' },
    React.createElement(
      'a',
      { onClick: function onClick() {
          return changeMonth(date.month() - 1);
        } },
      '‹'
    ),
    React.createElement(
      'h1',
      { onClick: function onClick() {
          return resetDate();
        } },
      date.format('MMMM'),
      ' ',
      React.createElement(
        'small',
        null,
        date.format('YYYY')
      )
    ),
    React.createElement(
      'a',
      { onClick: function onClick() {
          return changeMonth(date.month() + 1);
        } },
      '›'
    )
  );
};

let Day = function Day(_ref2) {
  let currentDate = _ref2.currentDate;
  let date = _ref2.date;
  let startDate = _ref2.startDate;
  let endDate = _ref2.endDate;
  let _onClick = _ref2.onClick;

  let className = [];

  if (moment().isSame(date, 'day')) {
    className.push('active');
  }

  if (date.isSame(startDate, 'day')) {
    className.push('start');
  }

  if (date.isBetween(startDate, endDate, 'day')) {
    className.push('between');
  }

  if (date.isSame(endDate, 'day')) {
    className.push('end');
  }

  if (!date.isSame(currentDate, 'month')) {
    className.push('muted');
  }

  return React.createElement(
    'span',
    { onClick: function onClick() {
        return _onClick(date);
      }, currentDate: date, className: className.join(' ') },
    date.date()
  );
};

let Days = function Days(_ref3) {
  let date = _ref3.date;
  let startDate = _ref3.startDate;
  let endDate = _ref3.endDate;
  let _onClick2 = _ref3.onClick;

  let thisDate = moment(date);
  let daysInMonth = moment(date).daysInMonth();
  let firstDayDate = moment(date).startOf('month');
  let previousMonth = moment(date).subtract(1, 'month');
  let previousMonthDays = previousMonth.daysInMonth();
  let nextsMonth = moment(date).add(1, 'month');
  let days = [];
  let labels = [];

  for (let i = 1; i <= 7; i++) {
    labels.push(React.createElement(
      'span',
      { className: 'label' },
      moment().day(i).format('ddd')
    ));
  }

  for (let i = firstDayDate.day(); i > 1; i--) {
    previousMonth.date(previousMonthDays - i + 2);

    days.push(React.createElement(Day, { key: moment(previousMonth).format('DD MM YYYY'), onClick: function onClick(date) {
        return _onClick2(date);
      }, currentDate: date, date: moment(previousMonth), startDate: startDate, endDate: endDate }));
  }

  for (let i = 1; i <= daysInMonth; i++) {
    thisDate.date(i);

    days.push(React.createElement(Day, { key: moment(thisDate).format('DD MM YYYY'), onClick: function onClick(date) {
        return _onClick2(date);
      }, currentDate: date, date: moment(thisDate), startDate: startDate, endDate: endDate }));
  }

  let daysCount = days.length;
  for (let i = 1; i <= 42 - daysCount; i++) {
    nextsMonth.date(i);
    days.push(React.createElement(Day, { key: moment(nextsMonth).format('DD MM YYYY'), onClick: function onClick(date) {
        return _onClick2(date);
      }, currentDate: date, date: moment(nextsMonth), startDate: startDate, endDate: endDate }));
  }

  return React.createElement(
    'nav',
    { className: 'calendar--days' },
    labels.concat(),
    days.concat()
  );
};

let Calendar = function (_React$Component) {
  _inherits(Calendar, _React$Component);

  function Calendar(props) {
    _classCallCheck(this, Calendar);

    let _this = _possibleConstructorReturn(this, _React$Component.call(this, props));

    _this.state = {
      date: moment(),
      startDate: moment().subtract(5, 'day'),
      endDate: moment().add(3, 'day')
    };
    return _this;
  }

  Calendar.prototype.resetDate = function resetDate() {
    this.setState({
      date: moment()
    });
  };

  Calendar.prototype.changeMonth = function changeMonth(month) {
    let date = this.state.date;

    date.month(month);

    this.setState(date);
  };

  Calendar.prototype.changeDate = function changeDate(date) {
    let _state = this.state;
    let startDate = _state.startDate;
    let endDate = _state.endDate;

    if (startDate === null || date.isBefore(startDate, 'day') || !startDate.isSame(endDate, 'day')) {
      startDate = moment(date);
      endDate = moment(date);
    } else if (date.isSame(startDate, 'day') && date.isSame(endDate, 'day')) {
      startDate = null;
      endDate = null;
    } else if (date.isAfter(startDate, 'day')) {
      endDate = moment(date);
    }

    this.setState({
      startDate: startDate,
      endDate: endDate
    });
  };

  Calendar.prototype.render = function render() {
    let _this2 = this;

    let _state2 = this.state;
    let date = _state2.date;
    let startDate = _state2.startDate;
    let endDate = _state2.endDate;

    return React.createElement(
      'div',
      { className: 'calendar' },
      React.createElement(Heading, { date: date, changeMonth: function changeMonth(month) {
          return _this2.changeMonth(month);
        }, resetDate: function resetDate() {
          return _this2.resetDate();
        } }),
      React.createElement(Days, { onClick: function onClick(date) {
          return _this2.changeDate(date);
        }, date: date, startDate: startDate, endDate: endDate })
    );
  };

  return Calendar;
}(React.Component);

ReactDOM.render(React.createElement(Calendar, null), document.getElementById('calendar'));

document.querySelectorAll('.button').forEach(button => {

  let getVar = variable => getComputedStyle(button).getPropertyValue(variable);

  button.addEventListener('click', e => {

      if(!button.classList.contains('active')) {

          button.classList.add('active');

          gsap.to(button, {
              keyframes: [{
                  '--left-wing-first-x': 50,
                  '--left-wing-first-y': 100,
                  '--right-wing-second-x': 50,
                  '--right-wing-second-y': 100,
                  duration: .2,
                  onComplete() {
                      gsap.set(button, {
                          '--left-wing-first-y': 0,
                          '--left-wing-second-x': 40,
                          '--left-wing-second-y': 100,
                          '--left-wing-third-x': 0,
                          '--left-wing-third-y': 100,
                          '--left-body-third-x': 40,
                          '--right-wing-first-x': 50,
                          '--right-wing-first-y': 0,
                          '--right-wing-second-x': 60,
                          '--right-wing-second-y': 100,
                          '--right-wing-third-x': 100,
                          '--right-wing-third-y': 100,
                          '--right-body-third-x': 60
                      })
                  }
              }, {
                  '--left-wing-third-x': 20,
                  '--left-wing-third-y': 90,
                  '--left-wing-second-y': 90,
                  '--left-body-third-y': 90,
                  '--right-wing-third-x': 80,
                  '--right-wing-third-y': 90,
                  '--right-body-third-y': 90,
                  '--right-wing-second-y': 90,
                  duration: .2
              }, {
                  '--rotate': 50,
                  '--left-wing-third-y': 95,
                  '--left-wing-third-x': 27,
                  '--right-body-third-x': 45,
                  '--right-wing-second-x': 45,
                  '--right-wing-third-x': 60,
                  '--right-wing-third-y': 83,
                  duration: .25
              }, {
                  '--rotate': 55,
                  '--plane-x': -8,
                  '--plane-y': 24,
                  duration: .2
              }, {
                  '--rotate': 40,
                  '--plane-x': 45,
                  '--plane-y': -180,
                  '--plane-opacity': 0,
                  duration: .3,
                  onComplete() {
                      setTimeout(() => {
                          button.removeAttribute('style');
                          gsap.fromTo(button, {
                              opacity: 0,
                              y: -8
                          }, {
                              opacity: 1,
                              y: 0,
                              clearProps: true,
                              duration: .3,
                              onComplete() {
                                  button.classList.remove('active');
                              }
                          })
                      }, 2000)
                  }
              }]
          })

          gsap.to(button, {
              keyframes: [{
                  '--text-opacity': 0,
                  '--border-radius': 0,
                  '--left-wing-background': getVar('--primary-darkest'),
                  '--right-wing-background': getVar('--primary-darkest'),
                  duration: .1
              }, {
                  '--left-wing-background': getVar('--primary'),
                  '--right-wing-background': getVar('--primary'),
                  duration: .1
              }, {
                  '--left-body-background': getVar('--primary-dark'),
                  '--right-body-background': getVar('--primary-darkest'),
                  duration: .4
              }, {
                  '--success-opacity': 1,
                  '--success-scale': 1,
                  duration: .25,
                  delay: .25
              }]
          })

      }

  })

});

const timer = document.querySelectorAll('#created_at');
      timer.forEach(date => 
      {
        
        let d = new Date(date.innerText);
        date.innerText = d.toDateString();
        
      })
