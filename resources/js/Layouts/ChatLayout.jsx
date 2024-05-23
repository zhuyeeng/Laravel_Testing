// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { usePage } from "@inertiajs/react";

const ChatLayout = ({ children }) => {
    const page = usePage();
    const conversations = page.props.conversations;
    const selectedConversations = page.props.selectedConversations;

    console.log("conversations", conversations);
    console.log("conversations", selectedConversations);

    return (
        <>
            ChatLayout
            <div class='text-gray-300'>{children}</div>
        </>
    )
}

export default ChatLayout;