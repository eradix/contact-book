import Modal from '@/Components/Modal';

export default function MessageModal({show, title, message, onClose = () => {}}) {
    return (
        <Modal show={show} onClose={onclose}>
                <div className="bg-white rounded-lg shadow-lg p-6 text-center">
                    <h2 className="text-lg font-semibold mb-2">{title}</h2>
                    <p className="text-gray-600">{message}</p>
                    <button
                        onClick={onClose}
                        className="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Close
                    </button>
                </div>
        </Modal>
    );
}
