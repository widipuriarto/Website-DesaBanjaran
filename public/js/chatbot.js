const chatbotToggler = document.querySelector(".chatbot-toggler");
const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");
// element closeBtn sudah dihapus dari HTML

let isBotTyping = false;

// Pastikan baseURL aman
const apiBaseClean = baseURL.endsWith("/") ? baseURL : baseURL + "/";

// 1. Click Outside to Close
document.addEventListener(
  "mousedown",
  (e) => {
    if (document.body.classList.contains("show-chatbot")) {
      if (!e.target.closest(".chatbot") && !e.target.closest(".chatbot-toggler")) {
        document.body.classList.remove("show-chatbot");
      }
    }
  },
  true
);

// 2. Helper Create Bubble
const createChatLi = (message, className) => {
  const chatLi = document.createElement("li");
  chatLi.classList.add("chat", className);
  const defaultIcon = document.querySelector(".chat.incoming img");
  // Fallback icon path absolute agar aman
  const iconSrc = defaultIcon ? defaultIcon.src : apiBaseClean + "icon.png";

  let chatContent = className === "outgoing" ? `<p></p>` : `<img src="${iconSrc}" alt="Bot Icon"><p></p>`;
  chatLi.innerHTML = chatContent;
  chatLi.querySelector("p").innerText = message;
  return chatLi;
};

// 3. Generate Response
const generateResponse = (userMessage) => {
  if (isBotTyping) return;
  isBotTyping = true;
  const incomingChatLi = createChatLi("Sedang mengetik...", "incoming");
  chatbox.appendChild(incomingChatLi);
  chatbox.scrollTo(0, chatbox.scrollHeight);

  const formData = new FormData();
  formData.append("message", userMessage);

  fetch(apiBaseClean + "api/chat/send", {
    method: "POST",
    body: formData,
    headers: { "X-Requested-With": "XMLHttpRequest" },
  })
    .then((res) => res.json())
    .then((data) => {
      incomingChatLi.querySelector("p").innerHTML = data.reply.replace(/\*\*(.*?)\*\*/g, "<b>$1</b>").replace(/\n/g, "<br>");
    })
    .catch((err) => {
      console.error(err);
      incomingChatLi.querySelector("p").innerText = "Maaf, terjadi kesalahan koneksi.";
    })
    .finally(() => {
      isBotTyping = false;
      chatbox.scrollTo(0, chatbox.scrollHeight);
    });
};

const handleChat = () => {
  const userMessage = chatInput.value.trim();
  if (!userMessage) return;
  chatInput.value = "";
  chatbox.appendChild(createChatLi(userMessage, "outgoing"));
  chatbox.scrollTo(0, chatbox.scrollHeight);
  setTimeout(() => generateResponse(userMessage), 600);
};

chatInput.addEventListener("keydown", (e) => {
  if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
    e.preventDefault();
    handleChat();
  }
});
sendChatBtn.addEventListener("click", handleChat);
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
// closeBtn listener removed

// 4. Load History
const loadChatHistory = () => {
  fetch(apiBaseClean + "api/chat/history", { headers: { "X-Requested-With": "XMLHttpRequest" } })
    .then((res) => res.json())
    .then((data) => {
      if (data.length > 0) {
        chatbox.innerHTML = "";
        data.forEach((chat) => {
          const className = chat.sender === "user" ? "outgoing" : "incoming";
          const chatLi = createChatLi(chat.message, className);
          if (className === "incoming") {
            chatLi.querySelector("p").innerHTML = chat.message.replace(/\*\*(.*?)\*\*/g, "<b>$1</b>").replace(/\n/g, "<br>");
          }
          chatbox.appendChild(chatLi);
        });
        chatbox.scrollTo(0, chatbox.scrollHeight);
      }
    })
    .catch((err) => console.log("Guest/No History"));
};

loadChatHistory();
