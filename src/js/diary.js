// When the user clicks on <div>, open the popup
addListeners();
addHrefToDeleteButtons();
function showPopUpFunction(eventId) {
  var targetDiv = document.querySelector("#card" + eventId);
  console.log(targetDiv.style.display);
  if (targetDiv.style.display == "none" || targetDiv.style.display == "") {
    targetDiv.style.display = "flex";
  } else {
    targetDiv.style.display = "none";
  }
}
function addHrefToDeleteButtons() {
  var aList = document.querySelectorAll(
    ".event-list-element-button-delete-button"
  );
  aList.forEach((a) => {
    a.href =
      "../controller/eventDeleteController.php?event_id=" +
      a.id +
      "&location=" +
      window.location;
  });
}
function addListeners() {
  var addEvent = document.querySelector(".generic-add-button");
  addEvent.addEventListener("click", function () {
    openGenericPopup("add-event");
  });

  var targetDivs = document.querySelectorAll(".event-list-element-button");
  targetDivs.forEach((targetDiv) => {
    targetDiv.addEventListener("click", function () {
      showPopUpFunction(targetDiv.id.substring(3, targetDiv.id.length));
    });
  });
}

function openGenericPopup(id) {
  var backgroundOpacity = document.querySelector(".background-opacity");
  backgroundOpacity.hidden = false;

  var genericPopup = document.querySelector(".generic-popup#" + id);
  genericPopup.style.display = "flex";
        trapFocus(genericPopup);

  var closeGenericPopup = document.querySelector(".close-generic-popup");
  closeGenericPopup.hidden = false;
  closeGenericPopup.addEventListener("click", function () {
    dropGenericPopup(id);
  });

  backgroundOpacity.addEventListener("click", function () {
    dropGenericPopup(id);
  });
}

function dropGenericPopup(id) {
  var genericPopup = document.querySelector(".generic-popup#" + id);
  genericPopup.style.display = "none";
  var backgroundOpacity =
    document.getElementsByClassName("background-opacity")[0];
  backgroundOpacity.hidden = true;

  var closeEventButton = document.getElementsByClassName(
    "close-generic-popup"
  )[0];
  closeEventButton.hidden = true;
}

//Con esto cambiamos el color del evento dependiendo de su prioridad
var buttons = document.querySelectorAll(
  ".event-list-element-button-priority-background"
);
buttons.forEach((button) => {
  if (button.id == "1") {
    button.style.backgroundColor = "#C72D2D";
  } else if (button.id == "2") {
    button.style.backgroundColor = "#FBBF24";
  } else {
    button.style.backgroundColor = "#126D3F";
  }
});
function trapFocus(element) {
  var focusableEls = element.querySelectorAll(
    'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled]), input[type="submit"]:not([disabled])'
  );
  var closePopup = document.querySelector(".close-generic-popup");

  var firstFocusableEl = focusableEls[0];
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
