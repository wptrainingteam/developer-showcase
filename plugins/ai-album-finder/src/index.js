/**
 * AI Album Finder Chatbot
 *
 * Main entry point for the React chatbot interface
 */

import { createRoot } from '@wordpress/element';
import Chatbot from './components/Chatbot';
import './style.scss';

console.log('AI Album Finder Chatbot initialized');

// Initialize the chatbot when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
	const chatbotContainer = document.getElementById('ai-album-finder-chatbot');

	if (chatbotContainer) {
		const root = createRoot(chatbotContainer);
		root.render(<Chatbot />);
	}
});
