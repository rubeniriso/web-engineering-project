function runScript() {
  cropTitles();
  addListeners();
}
function cropTitle(span) {
  var minimum = 330;
  var id = span.id.split("s")[1];
  var note = document.querySelector("li#l" + id);
  if (span.innerHTML.length > 20) {
    span.innerHTML = span.innerHTML.substring(0, 20);
    span.innerHTML += "...";
  }
}
function cropTitles() {
  var spanArray = document.querySelectorAll("span");
  spanArray.forEach((span) => {
    cropTitle(span);
  });
}
function addListeners() {
  var addNote = document.querySelector(".generic-add-button");

  addNote.addEventListener("click", function () {
    openGenericPopup("div-add-note-popup");
  });
  //window.addEventListener("resize", cropTitles());
}

function openGenericPopup(id) {
  var backgroundOpacity =
    document.getElementsByClassName("background-opacity")[0];
  backgroundOpacity.hidden = false;

  var genericPopup = document.querySelector(".generic-popup#" + id);
  genericPopup.style.display = "flex";
  console.log("hola");
  var closeGenericPopup = document.querySelector(".close-generic-popup");
  closeGenericPopup.hidden = false;
  closeGenericPopup.addEventListener("click", function () {
    dropGenericPopup(id);
  });
  trapFocus(genericPopup);

  var backgroundOpacity = document.querySelector(".background-opacity");
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
function trapFocus(element) {
  var focusableEls = element.querySelectorAll(
    'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled]), input[type="submit"]:not([disabled])'
  );
  var closePopup = document.querySelector(".close-generic-popup");
  console.log(focusableEls);
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
