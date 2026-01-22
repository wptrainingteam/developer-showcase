/**
 * AI Album Finder Chatbot
 *
 * @package ai-album-finder
 */

(function() {
	'use strict';

	const { restUrl, nonce, botName, strings } = window.aiAlbumFinderData || {};

	if (!restUrl || !nonce) {
		console.error('AI Album Finder: Missing required data');
		return;
	}

	let chatHistory = [];
	let isProcessing = false;

	/**
	 * Creates and injects the chatbot UI into the page.
	 */
	function createChatbotUI() {
		const container = document.createElement('div');
		container.className = 'ai-album-finder-chatbot-container';
		container.innerHTML = `
			<button class="ai-album-finder-chatbot-button" aria-label="${strings.chatTitle}">
				<span class="screen-reader-text">${strings.chatTitle}</span>
			</button>
			<div class="ai-album-finder-chatbot-window">
				<div class="ai-album-finder-chatbot-header">
					<h3 class="ai-album-finder-chatbot-title">${strings.chatTitle}</h3>
					<button class="ai-album-finder-chatbot-close" aria-label="${strings.close}">×</button>
				</div>
				<div class="ai-album-finder-chatbot-messages"></div>
				<div class="ai-album-finder-chatbot-input">
					<input 
						type="text" 
						placeholder="${strings.placeholder}" 
						aria-label="${strings.placeholder}"
					/>
					<button class="ai-album-finder-chatbot-send">${strings.send}</button>
				</div>
			</div>
		`;

		document.body.appendChild(container);

		// Get references to elements
		const button = container.querySelector('.ai-album-finder-chatbot-button');
		const window = container.querySelector('.ai-album-finder-chatbot-window');
		const closeButton = container.querySelector('.ai-album-finder-chatbot-close');
		const input = container.querySelector('.ai-album-finder-chatbot-input input');
		const sendButton = container.querySelector('.ai-album-finder-chatbot-send');
		const messagesContainer = container.querySelector('.ai-album-finder-chatbot-messages');

		// Toggle chatbot visibility
		button.addEventListener('click', () => {
			window.classList.add('visible');
			input.focus();

			// Add welcome message on first open
			if (chatHistory.length === 0) {
				addMessage('bot', strings.welcomeMessage);
			}
		});

		closeButton.addEventListener('click', () => {
			window.classList.remove('visible');
		});

		// Send message on button click
		sendButton.addEventListener('click', () => {
			sendMessage(input, messagesContainer, sendButton);
		});

		// Send message on Enter key
		input.addEventListener('keypress', (e) => {
			if (e.key === 'Enter' && !e.shiftKey) {
				e.preventDefault();
				sendMessage(input, messagesContainer, sendButton);
			}
		});
	}

	/**
	 * Sends a message to the chatbot.
	 *
	 * @param {HTMLInputElement} input Input element.
	 * @param {HTMLElement} messagesContainer Messages container.
	 * @param {HTMLButtonElement} sendButton Send button.
	 */
	function sendMessage(input, messagesContainer, sendButton) {
		const message = input.value.trim();
		
		if (!message || isProcessing) {
			return;
		}

		// Add user message to UI
		addMessage('user', message);
		chatHistory.push({ role: 'user', content: message });

		// Clear input
		input.value = '';

		// Show loading indicator
		const loadingMessage = addLoadingMessage();

		// Disable input while processing
		isProcessing = true;
		input.disabled = true;
		sendButton.disabled = true;

		// Send request to API
		fetch(`${restUrl}chat`, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-WP-Nonce': nonce
			},
			body: JSON.stringify({
				message: message,
				history: chatHistory
			})
		})
		.then(response => response.json())
		.then(data => {
			// Remove loading message
			if (loadingMessage) {
				loadingMessage.remove();
			}

			if (data.success && data.response) {
				addMessage('bot', data.response);
				chatHistory.push({ role: 'bot', content: data.response });
			} else {
				addMessage('bot', data.error || strings.errorMessage);
			}
		})
		.catch(error => {
			console.error('AI Album Finder error:', error);
			
			// Remove loading message
			if (loadingMessage) {
				loadingMessage.remove();
			}

			addMessage('bot', strings.errorMessage);
		})
		.finally(() => {
			// Re-enable input
			isProcessing = false;
			input.disabled = false;
			sendButton.disabled = false;
			input.focus();
		});
	}

	/**
	 * Adds a message to the chat.
	 *
	 * @param {string} role Message role ('user' or 'bot').
	 * @param {string} content Message content.
	 */
	function addMessage(role, content) {
		const messagesContainer = document.querySelector('.ai-album-finder-chatbot-messages');
		
		const messageDiv = document.createElement('div');
		messageDiv.className = `ai-album-finder-message ${role}`;
		
		const contentDiv = document.createElement('div');
		contentDiv.className = 'ai-album-finder-message-content';
		contentDiv.textContent = content;
		
		messageDiv.appendChild(contentDiv);
		messagesContainer.appendChild(messageDiv);
		
		// Scroll to bottom
		messagesContainer.scrollTop = messagesContainer.scrollHeight;
	}

	/**
	 * Adds a loading message indicator.
	 *
	 * @return {HTMLElement} Loading message element.
	 */
	function addLoadingMessage() {
		const messagesContainer = document.querySelector('.ai-album-finder-chatbot-messages');
		
		const messageDiv = document.createElement('div');
		messageDiv.className = 'ai-album-finder-message bot loading';
		
		const contentDiv = document.createElement('div');
		contentDiv.className = 'ai-album-finder-message-content';
		contentDiv.innerHTML = `
			<span class="ai-album-finder-loading-dot"></span>
			<span class="ai-album-finder-loading-dot"></span>
			<span class="ai-album-finder-loading-dot"></span>
		`;
		
		messageDiv.appendChild(contentDiv);
		messagesContainer.appendChild(messageDiv);
		
		// Scroll to bottom
		messagesContainer.scrollTop = messagesContainer.scrollHeight;
		
		return messageDiv;
	}

	// Initialize chatbot when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', createChatbotUI);
	} else {
		createChatbotUI();
	}
})();
