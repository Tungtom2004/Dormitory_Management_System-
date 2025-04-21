document.addEventListener("DOMContentLoaded", function () {
  const chatbotContainer = document.getElementById("chatbot-container");
  const closeBtn = document.getElementById("close-btn");
  const sendBtn = document.getElementById("send-btn");
  const chatbotInput = document.getElementById("chatbot-input");
  const chatbotMessages = document.getElementById("chatbot-messages");

  const chatbotIcon = document.getElementById("chatbot-icon");
  const closeButton = document.getElementById("close-btn");

  chatbotIcon.addEventListener("click", function () {
    chatbotContainer.classList.remove("hidden");
    chatbotIcon.style.display = "none";
  });

  closeButton.addEventListener("click", function () {
    chatbotContainer.classList.add("hidden");
    chatbotIcon.style.display = "flex";
  });

  sendBtn.addEventListener("click", sendMessage);
  chatbotInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      sendMessage();
    }
  });

  function sendMessage() {
    const userMessage = chatbotInput.value.trim();
    if (userMessage) {
      appendMessage("user", userMessage);
      chatbotInput.value = "";
      getBotResponse(userMessage);
    }
  }

  function appendMessage(sender, message) {
    const messageElement = document.createElement("div");
    messageElement.classList.add("message", sender);
    
    const icon = document.createElement("span");
    icon.classList.add("icon");
    icon.innerHTML = sender === "user" ? "👤" : "🤖";
    
    const text = document.createElement("span");
    text.textContent = message;

    messageElement.appendChild(icon);
    messageElement.appendChild(text);

    chatbotMessages.appendChild(messageElement);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
  }

  async function getBotResponse(userMessage) {
    const apiKey = "fsQGJ5CKCCmjs0Y55JCpMBEBxHulvj3VhSjEqaCj";
    const apiUrl = "https://api.cohere.ai/v1/chat";

    try {
      const response = await fetch(apiUrl, {
        method: "POST",
        headers: {
          "Authorization": `Bearer ${apiKey}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          message: userMessage,
          model: "command-r-plus",
          temperature: 0.7,
          chat_history: [],
        }),
      });

      const data = await response.json();
      const botMessage = data.text;
      appendMessage("bot", botMessage);
    } catch (error) {
      console.error("Lỗi gọi API Cohere:", error);
      appendMessage("bot", "Xin lỗi, chatbot đang gặp sự cố. Hãy thử lại sau.");
    }
  }
});
