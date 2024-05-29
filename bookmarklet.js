javascript: (function () {
  var url = window.location.href;
  var readLaterUrl = "https://endpoint.com/" + encodeURIComponent(url);
  fetch(readLaterUrl).then((response) => {
    if (response.ok) {
      alert("URL saved to Read Later");
    } else {
      alert("Failed to save URL");
    }
  });
})();
