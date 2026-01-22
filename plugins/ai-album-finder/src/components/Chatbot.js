/**
 * Chatbot Component
 *
 * A React component that provides an AI-powered chat interface
 * using the WordPress AI Client API
 */

import { useState, useRef, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Button, TextareaControl, Spinner } from '@wordpress/components';

const Chatbot = () => {
	const [messages, setMessages] = useState([]);
	const [input, setInput] = useState('');
	const [isLoading, setIsLoading] = useState(false);
	const [isOpen, setIsOpen] = useState(false);
	const messagesEndRef = useRef(null);

	// Auto-scroll to bottom when new messages arrive
	useEffect(() => {
		messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
	}, [messages]);

	const sendMessage = async () => {
		if (!input.trim() || isLoading) {
			return;
		}

		const userMessage = input.trim();
		setInput('');
		setIsLoading(true);

		// Add user message to chat
		setMessages((prev) => [
			...prev,
			{ role: 'user', content: userMessage },
		]);

		try {
			// Use the WordPress AI Client API
			if (window.wpAIClient && window.wpAIClient.chat) {
				const response = await window.wpAIClient.chat({
					messages: [
						{
							role: 'system',
							content:
								'You are a helpful assistant that helps users find music albums based on their preferences. Ask clarifying questions and provide album recommendations.',
						},
						...messages.map((msg) => ({
							role: msg.role,
							content: msg.content,
						})),
						{ role: 'user', content: userMessage },
					],
				});

				// Add AI response to chat
				if (response && response.content) {
					setMessages((prev) => [
						...prev,
						{ role: 'assistant', content: response.content },
					]);
				}
			} else {
				throw new Error('WP AI Client is not available');
			}
		} catch (error) {
			console.error('Error sending message:', error);
			setMessages((prev) => [
				...prev,
				{
					role: 'assistant',
					content: __(
						'Sorry, I encountered an error. Please try again.',
						'ai-album-finder'
					),
				},
			]);
		} finally {
			setIsLoading(false);
		}
	};

	const handleKeyPress = (e) => {
		if (e.key === 'Enter' && !e.shiftKey) {
			e.preventDefault();
			sendMessage();
		}
	};

	return (
		<div className="ai-album-finder-chatbot">
			{/* Chatbot toggle button */}
			<button
				className="chatbot-toggle"
				onClick={() => setIsOpen(!isOpen)}
				aria-label={
					isOpen
						? __('Close chatbot', 'ai-album-finder')
						: __('Open chatbot', 'ai-album-finder')
				}
			>
				{isOpen ? '✕' : '💬'}
			</button>

			{/* Chatbot modal */}
			{isOpen && (
				<div className="chatbot-modal">
					<div className="chatbot-header">
						<h3>{__('AI Album Finder', 'ai-album-finder')}</h3>
						<p>
							{__(
								"Let's find your next favorite album!",
								'ai-album-finder'
							)}
						</p>
					</div>

					<div className="chatbot-messages">
						{messages.length === 0 && (
							<div className="chatbot-welcome">
								<p>
									{__(
										'Hi! I can help you discover music albums. What kind of music are you in the mood for?',
										'ai-album-finder'
									)}
								</p>
							</div>
						)}
						{messages.map((message, index) => (
							<div
								key={index}
								className={`chatbot-message chatbot-message--${message.role}`}
							>
								<div className="chatbot-message-content">
									{message.content}
								</div>
							</div>
						))}
						{isLoading && (
							<div className="chatbot-message chatbot-message--assistant">
								<div className="chatbot-message-content">
									<Spinner />
								</div>
							</div>
						)}
						<div ref={messagesEndRef} />
					</div>

					<div className="chatbot-input">
						<TextareaControl
							value={input}
							onChange={setInput}
							onKeyDown={handleKeyPress}
							placeholder={__(
								'Type your message...',
								'ai-album-finder'
							)}
							rows={2}
							disabled={isLoading}
						/>
						<Button
							variant="primary"
							onClick={sendMessage}
							disabled={isLoading || !input.trim()}
						>
							{__('Send', 'ai-album-finder')}
						</Button>
					</div>
				</div>
			)}
		</div>
	);
};

export default Chatbot;
