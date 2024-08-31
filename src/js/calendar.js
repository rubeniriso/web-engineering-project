function createMonthNameHeader(monthNumber) {
  var months = new Array(
    "Ene",
    "Feb",
    "Mar",
    "Abr",
    "May",
    "Jun",
    "Jul",
    "Ago",
    "Sep",
    "Oct",
    "Nov",
    "Dic"
  );
  var monthNameHeader = document.createElement("p");
  monthNameHeader.className = "month-name-header";
  monthNameHeader.innerHTML = months[monthNumber];
  return monthNameHeader;
}
function createWeekdayRow() {
  var weekdayArray = new Array("L", "M", "X", "J", "V", "S", "D");
  var weekdayHeader = document.createElement("thead");
  weekdayArray.forEach((weekday) => {
    var td = document.createElement("td");
    td.innerHTML = weekday;
    td.className = "weekday";
    weekdayHeader.appendChild(td);
  });
  return weekdayHeader;
}

function createWeekRow(day, weekday, lastDay, weekCount, isCurrentMonth, date) {
  var weekRow = document.createElement("tr"),
    colorId;
  if (weekCount % 2 == 0) colorId = "colorId1";
  else colorId = "colorId2";
  if (isCurrentMonth && day == new Date().getDay()) colorId = "colorIdCurrent";
  weekRow.id = colorId;

  for (var i = 0; i < 7; i++) {
    var td = document.createElement("td");
    if (i < weekday || day > lastDay) {
      td.innerHTML = " ";
      td.id = "empty-day-background";
    } else {
      td.className = "day";
      td.id = "m" + date.getMonth() + "d" + day;
      var input = document.createElement("input");
      input.type = "button";
      date.setDate(day);
      input.alt = date.toLocaleString("es-ES", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
      });
      input.className = "dayInputButton";
      input.value = day;
      input.id = date.getTime();
      input.addEventListener("click", function () {
        showDayEvents(this);
      });
      td.appendChild(input);
      day++;
    }
    weekRow.appendChild(td);
  }

  return [day, weekRow];
}
function createMonth(month, date) {
  date.setDate(1);
  date.setMonth(month);
  var weekday = date.getDay(),
    actualDay = date.getDate(),
    weekRowArray = Array(),
    i = 0,
    weekCount = 0,
    lastDay = getLastDayOfMonth(month, date),
    isCurrentMonth = month === new Date().getMonth();
  europeanWeekDays = Array(6, 0, 1, 2, 3, 4, 5);
  weekday = europeanWeekDays[weekday];
  while (weekCount < 6 && actualDay <= lastDay) {
    var weekRow;
    [actualDay, weekRow] = createWeekRow(
      actualDay,
      weekday,
      lastDay,
      weekCount,
      isCurrentMonth,
      date
    );
    weekRowArray.push(weekRow);
    weekday = 0;
    weekCount++;
  }
  var monthWrapper = document.createElement("div");
  monthWrapper.className = "month-wrapper";
  monthWrapper.id = month;

  monthWrapper.appendChild(createMonthNameHeader(month));

  var monthDaysTable = document.createElement("table");
  monthDaysTable.appendChild(createWeekdayRow());

  weekRowArray.forEach((weekRow) => {
    monthDaysTable.appendChild(weekRow);
  });
  monthWrapper.appendChild(monthDaysTable);
  return monthWrapper;
}

function createYearlyCalendar(year) {
  var date = new Date();
  date.setYear(year);
  var yearlyWrapper = document.createElement("div");
  yearlyWrapper.className = "year-wrapper";
  for (var i = 0; i < 12; i++) {
    var monthWrapper = createMonth(i, date);
    yearlyWrapper.append(monthWrapper);
  }
  document.body.appendChild(yearlyWrapper);
  addCalendarListeners();
}

function getLastDayOfMonth(month, date) {
  var dateAux = date;
  dateAux.setMonth(month + 1);
  dateAux.setDate(1);
  dateAux.setDate(date.getDate() - 1);
  return dateAux.getDate();
}

function yearBack(year) {
  document.querySelector("p.current-year-text").innerHTML = Number(year) - 1;
  var yearWrapper = document.getElementsByClassName("year-wrapper");
  yearWrapper[0].remove();
  createYearlyCalendar(Number(year) - 1);
}
function yearForward(year) {
  document.querySelector("p.current-year-text").innerHTML = Number(year) + 1;
  var yearWrapper = document.getElementsByClassName("year-wrapper");
  yearWrapper[0].remove();
  createYearlyCalendar(Number(year) + 1);
}
function addCalendarListeners() {
  var calendarDays = document.querySelectorAll(".dayInputButton");
  calendarDays.forEach((day) => {
    day.addEventListener("click", function () {
      seeEventOnCLickedDay(this);
    });
  });
}
function startPage() {
  createYearlyCalendar(2022);
  // document
  //   .getElementsByClassName("closeSelectEventButton")[0]
  //   .addEventListener("click", function () {
  //     closeSelectEvent();
  //   });
  document
    .getElementsByClassName("background-opacity")[0]
    .addEventListener("click", function () {
      closeSelectEvent();
    });
  document
    .getElementsByClassName("close-event-button")[0]
    .addEventListener("click", function () {
      closeSelectEvent();
    });
}
function showDayEvents(element) {
  var dateHeader = document.getElementsByClassName("select-events-date")[0];
  var date = new Date(Number(element.id));

  month = date.toLocaleString("es-ES", { month: "short" });
  month[0].toUpperCase();
  dateHeader.innerHTML =
    date.getDate() + " " + month + " " + date.getFullYear();

  var backgroundOpacity =
    document.getElementsByClassName("background-opacity")[0];
  backgroundOpacity.hidden = false;

  var selectEvents = document.querySelector(".select-events");
  selectEvents.style.display = "flex";

  var calendarDiv = document.getElementsByClassName("year-wrapper")[0];
  calendarDiv.style = "pointer-events: none";

  var closeEventButton =
    document.getElementsByClassName("close-event-button")[0];
  closeEventButton.hidden = false;
}
function closeSelectEvent() {
  var selectEvent = document.getElementsByClassName("select-events")[0];
  selectEvent.style.display = "none";
  var backgroundOpacity =
    document.getElementsByClassName("background-opacity")[0];
  backgroundOpacity.hidden = true;
  var calendarDiv = document.getElementsByClassName("year-wrapper")[0];
  calendarDiv.style = "pointer-events: all";
  var closeEventButton =
    document.getElementsByClassName("close-event-button")[0];
  closeEventButton.hidden = true;
  var ul = document.querySelector("ul");
  if (ul != null) ul.remove();
  var emptyEventsContainer = document.querySelector(
    ".empty-event-list-container"
  );
  if (emptyEventsContainer != null) emptyEventsContainer.remove();
}

function seeEventOnCLickedDay(element) {
  var elementId = Number(element.id);
  var date = new Date(elementId);
  date.setHours(12, 00, 00, 00);
  var dateString = date.toISOString().slice(0, 10);
  var day = dateString.substring(8, 10);
  var month = dateString.substring(5, 7);
  var year = dateString.substring(0, 4);
  var dateString = year + "-" + month + "-" + day;
  console.log(dateString);
  fetch("../controller/CalendarGetEventController.php?date=" + dateString)
    .then((response) => response.json())
    .then((data) => {
      var eventPopup = document.querySelector(".select-events");
      if (data != null) {
        var ul = document.createElement("ul");
        ul.className = "event-list";
        data.forEach((event) => {
          var li = createEventInsideElement(event);
          ul.appendChild(li);
        });
        eventPopup.appendChild(ul);
      } else {
        var div = document.createElement("div");
        div.className = "empty-event-list-container";
        var p = document.createElement("p");
        p.className = "empty-event-list-text";
        p.innerHTML = "No hay eventos.";
        div.appendChild(p);
        var p = document.createElement("p");
        p.className = "empty-event-list-what-to-do";
        p.innerHTML = "Para añadir eventos, ve a myDiary.";
        div.appendChild(p);
        eventPopup.appendChild(div);
      }
      trapFocus(eventPopup);
    })
    .catch((err) => console.log(err));
}

function showPopUpFunction(eventId) {
  var targetDiv = document.querySelector("#card" + eventId);
  if (targetDiv.style.display == "none" || targetDiv.style.display == "") {
    targetDiv.style.display = "flex";
  } else {
    targetDiv.style.display = "none";
  }
}

function getColor(id) {
  if (id == "1") {
    return "#C72D2D";
  } else if (id == "2") {
    return "#FBBF24";
  } else {
    return "#126D3F";
  }
}

function createEventInsideElement(event) {
  var li = document.createElement("li");
  li.className = "event-list-element";

  var div = document.createElement("div");
  div.className = "event-list-element-container";

  var button = document.createElement("button");
  button.className = "event-list-element-button";
  button.addEventListener("click", function () {
    showPopUpFunction(button.id.substring(3, button.id.length));
  });
  button.id = "btn" + event["event_id"];

  var span = document.createElement("span");
  span.className = "event-list-element-button-priority-background";
  span.id = event["priority"];
  span.innerHTML = "&nbsp;";
  span.style.background = getColor(span.id);

  var p = document.createElement("p");
  p.className = "event-list-element-button-text";
  p.innerHTML = event["title"];

  var a = document.createElement("a");
  a.className = "event-list-element-button-delete-button";
  a.href =
    "../controller/eventDeleteController.php?event_id=" +
    event["event_id"] +
    "&location=" +
    window.location;

  var img = document.createElement("img");
  img.className = "event-list-element-button-delete-button-image";
  img.alt = "Eliminar evento";
  img.src = "../../../resources/cross4.svg";
  a.appendChild(img);

  button.appendChild(span);
  button.appendChild(p);
  button.appendChild(a);

  var div2 = document.createElement("div");
  div2.className = "event-list-element-text-container";
  div2.id = "card" + event["event_id"];

  var p2 = document.createElement("p");
  p2.className = "event-list-element-text";
  p2.innerText = event["description"];

  div2.appendChild(p2);

  div.appendChild(button);
  div.appendChild(div2);

  li.appendChild(div);
  return li;
}
function trapFocus(element) {
  var focusableEls = element.querySelectorAll(
    'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])'
  );
  var closePopup = document.querySelector(".close-event-button");
  // Cojo 
  if (focusableEls.length == 0)
      focusableEls = document.querySelectorAll(".close-event-button");
  var firstFocusableEl = focusableEls[0];
  console.log(firstFocusableEl);
  var lastFocusableEl = focusableEls[focusableEls.length - 1];
  firstFocusableEl.focus();
  var KEYCODE_TAB = 9;
  document.addEventListener("keydown", function (e) {
    var isTabPressed = e.key === "Tab" || e.keyCode === KEYCODE_TAB;
    if (!isTabPressed) {
      return;
    }
    if (e.shiftKey) {
      /* shift + tab */ if (document.activeElement === firstFocusableEl) {
        closePopup.focus();
        e.preventDefault();
      } else if (document.activeElement === closePopup) {
        lastFocusableEl.focus();
        e.preventDefault();
      }
    } /* tab */ else {
      if (document.activeElement === lastFocusableEl) {
        closePopup.focus();
        e.preventDefault();
      } else if (document.activeElement === closePopup) {
        firstFocusableEl.focus();
        e.preventDefault();
      }
    }
  });
}
