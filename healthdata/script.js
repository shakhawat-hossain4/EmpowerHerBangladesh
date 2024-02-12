const expertData = [
    
    // Additional women experts from Bangladesh
    {
        name: "Bangladeshi Women's Health Specialist",
        category: "Health",
        education: "MBBS, MD in Gynecology",
        contact: "bdwomenshealth@example.com",
        recommendation: "Promote women's health awareness and provide specialized care.",
        picture: "healthspecialist.jpeg", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    {
        name: "Nutritionist for Bangladeshi Women",
        category: "Health",
        education: "Certified Nutritionist",
        contact: "bdnutritionist@example.com",
        recommendation: "Create nutrition plans tailored to the dietary preferences and needs of Bangladeshi women.",
        picture: "Aysha-siddika-removebg-preview.png", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    {
        name: "Bangladeshi Women's Rights Advocate",
        category: "Women's Rights",
        education: "MA in Women's Studies",
        contact: "bdwomensrights@example.com",
        recommendation: "Advocate for women's rights, equality, and empowerment in Bangladesh.",
        picture: "Unknown-removebg-preview.png", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    

    {
        name: "Fitness Expert for Women",
        category: "Fitness",
        education: "Certified Personal Trainer",
        contact: "fitness@example.com",
        recommendation: "Incorporate both cardio and strength training into your fitness routine.",
        picture: "fitness.png", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    {
        name: "Defense Expert for Women",
        category: "Defense",
        education: "Former Military Officer",
        contact: "defense@example.com",
        recommendation: "Stay vigilant and follow safety protocols for personal security.",
        picture: "defense.png", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    {
        name: "Bangladeshi Women's Education Advocate",
        category: "Education",
        education: "Ph.D. in Education",
        contact: "bdeducation@example.com",
        recommendation: "Promote women's education and literacy in Bangladesh through advocacy and initiatives.",
        picture: "education.png", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    {
        name: "Bangladeshi Women's Entrepreneurship Coach",
        category: "Business",
        education: "Entrepreneurship Expert",
        contact: "bdentrepreneurship@example.com",
        recommendation: "Empower Bangladeshi women to start and grow their own businesses, fostering economic independence.",
        picture: "selina.png", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
    {
        name: "Bangladeshi Women's Mental Health Counselor",
        category: "Mental Health",
        education: "Licensed Counselor",
        contact: "bdmentalhealth@example.com",
        recommendation: "Provide mental health support and counseling to Bangladeshi women, addressing mental health challenges.",
        picture: "selina.jpg", // Path to the expert's picture
        chat: [] // Initialize an empty chat array for this expert
    },
];

// Function to display expert details and initialize chat
function displayExpertDetails(expert) {
    const expertName = document.getElementById('expert-name');
    const expertPicture = document.getElementById('expert-picture');
    const expertCategory = document.getElementById('expert-category');
    const expertEducation = document.getElementById('expert-education');
    const expertContact = document.getElementById('expert-contact');
    const expertRecommendation = document.getElementById('expert-recommendation');

    // Update the elements with the expert's information
    expertName.textContent = expert.name;
    expertPicture.src = expert.picture;
    expertCategory.textContent = `Category: ${expert.category}`;
    expertEducation.textContent = `Education: ${expert.education}`;
    expertContact.textContent = `Contact: ${expert.contact}`;
    expertRecommendation.textContent = expert.recommendation;

    // Initialize the chat messages
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.innerHTML = '';

    expert.chat.forEach((message) => {
        const messageElement = document.createElement('div');
        messageElement.textContent = message.text;
        chatMessages.appendChild(messageElement);
    });
}

// Function to send a chat message
// Function to send a chat message
function sendMessage() {
    const expertName = document.getElementById('expert-name').textContent;
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');

    const messageText = chatInput.value.trim();
    if (messageText === '') {
        return;
    }

    // Find the expert in expertData
    const expert = expertData.find((e) => e.name === expertName);

    // Add the message to the chat array
    expert.chat.push({ text: messageText });

    // Send the message to the server
    fetch('send_chat_message.php', {
        method: 'POST',
        body: JSON.stringify({ expertId: expert.id, message: messageText }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Message sent successfully
            // You can optionally update the chat UI here
        } else {
            console.error('Error sending message:', data.error);
        }
    })
    .catch(error => console.error('Error sending message:', error));

    // Create a new message element and append it to the chat
    const messageElement = document.createElement('div');
    messageElement.textContent = messageText;
    chatMessages.appendChild(messageElement);

    // Clear the chat input
    chatInput.value = '';
}
// Function to load experts list
function loadExpertsList() {
    const expertsList = document.getElementById('experts-list');
    expertData.forEach((expert) => {
        const listItem = document.createElement('li');
        listItem.textContent = expert.name;
        listItem.addEventListener('click', () => displayExpertDetails(expert));
        expertsList.appendChild(listItem);
    });
}
// Function to load chat messages for the selected expert
function loadChatMessages(expert) {
    // Send a request to the server to retrieve chat messages for the expert
    fetch('get_chat_messages.php?expertId=' + expert.id)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML = '';

            data.messages.forEach(message => {
                const messageElement = document.createElement('div');
                messageElement.textContent = message;
                chatMessages.appendChild(messageElement);
            });
        } else {
            console.error('Error retrieving chat messages:', data.error);
        }
    })
    .catch(error => console.error('Error retrieving chat messages:', error));
}
// Function to submit user opinion
function submitOpinion() {
    const opinionText = document.getElementById('opinion-text').value;

    // Sample code to submit an opinion (replace with actual submission logic)
    fetch('submit_opinion.php', {
        method: 'POST',
        body: JSON.stringify({ opinion: opinionText }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(message => {
        alert(message);
        document.getElementById('opinion-text').value = '';
    })
    .catch(error => console.error('Error submitting opinion:', error));
}

// Initialize the experts list and select the first expert by default
loadExpertsList();
if (expertData.length > 0) {
    displayExpertDetails(expertData[0]);
}

// Attach the send message function to the chat send button
const chatSendButton = document.getElementById('chat-send-button');
chatSendButton.addEventListener('click', sendMessage);

// Attach the submit opinion function to the opinion submit button
const opinionSubmitButton = document.getElementById('opinion-submit-button');
opinionSubmitButton.addEventListener('click', submitOpinion);
