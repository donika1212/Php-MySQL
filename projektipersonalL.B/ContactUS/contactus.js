document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contact-form");
  
    form.addEventListener("submit", function(event) {
      event.preventDefault();
  
      const messageInput = document.getElementById("message");
      const messageValue = messageInput.value.trim();
  
      if (messageValue === "") {
        alert("Please enter your message.");
        return;
      }
  
      const formData = {
        name: "Labeat Bytyqi",
        email: "labeat.bytyqi@gmail.com",
        instagram: "labeat_byt",
        snapchat: "labeat_bb",
        message: messageValue
      };
      console.log("Form data:", formData);
  
      form.reset();
    });
  });
  