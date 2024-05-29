javascript: (function () {
  var url = window.location.href;
  var readLaterUrl = "SERVICEURL.com/save.php?url=" + url;
  fetch(readLaterUrl).then((response) => {
    if (response.ok) {
      alert("URL saved to Read Later");
    } else {
      alert("Failed to save URL");
    }
  });
})();
