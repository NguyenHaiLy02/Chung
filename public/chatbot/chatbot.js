document.addEventListener('DOMContentLoaded', () => {
    const chatbotButton = document.getElementById('chatbot-button');
    const chatWindow = document.getElementById('chat-window');
    const closeChat = document.getElementById('close-chat');
    const sendMessageButton = document.getElementById('send-message');
    const chatInput = document.getElementById('chat-input');
    const chatContent = document.getElementById('chat-content');

    // Mở cửa sổ chat và ẩn icon
    chatbotButton.addEventListener('click', () => {
        chatWindow.style.display = 'flex'; // Hiển thị khung chat
        chatbotButton.classList.add('hide'); // Ẩn icon khi mở khung chat
    });

    // Đóng cửa sổ chat và hiển thị lại icon
    closeChat.addEventListener('click', () => {
        chatWindow.style.display = 'none'; // Ẩn khung chat
        chatbotButton.classList.remove('hide'); // Hiển thị lại icon khi đóng khung chat
    });

    // Hàm thêm tin nhắn vào khung chat
    function addMessageToChat(message, isUser) {
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('message', isUser ? 'user-message' : 'bot-message');
        messageContainer.textContent = message;
        chatContent.appendChild(messageContainer);
        chatContent.scrollTop = chatContent.scrollHeight; // Cuộn xuống dưới cùng
    }

    // Hàm gửi tin nhắn từ người dùng và nhận phản hồi từ chatbot
    async function sendMessage() {
        const userMessage = chatInput.value.trim();
        if (!userMessage) return; // Không gửi nếu tin nhắn rỗng

        // Hiển thị tin nhắn người dùng
        addMessageToChat(userMessage, true);
        chatInput.value = ''; // Xóa nội dung input sau khi gửi

        try {
            // Gửi yêu cầu tới API backend (Laravel)
            const response = await fetch("{{ route('chatbot.handle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message: userMessage }),
            });

            // Xử lý phản hồi từ backend
            const data = await response.json();
            if (response.ok) {
                addMessageToChat(data.message, false); // Hiển thị phản hồi từ chatbot
            } else {
                addMessageToChat('Xin lỗi, đã xảy ra lỗi. Vui lòng thử lại!', false);
            }
        } catch (error) {
            addMessageToChat('Không thể kết nối tới máy chủ. Vui lòng thử lại sau.', false);
        }
    }

    // Gửi tin nhắn khi nhấn nút
    sendMessageButton.addEventListener('click', sendMessage);

    // Gửi tin nhắn khi nhấn phím Enter
    chatInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }
    });
});
