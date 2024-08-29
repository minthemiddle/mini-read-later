javascript: (function () {
  var url = window.location.href;
  var token = 'your_unique_token'; // Replace 'your_unique_token' with your actual token
  var readLaterUrl = "SERVICEURL.com/save.php?url=" + encodeURIComponent(url) + "&token=" + encodeURIComponent(token);
  fetch(readLaterUrl).then((response) => {
    if (response.ok) {
      alert("URL saved to Read Later");
    } else {
      alert("Failed to save URL");
    }
  });
})();
