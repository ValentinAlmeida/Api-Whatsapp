import { ref } from 'vue';

const successMessage = ref<string | null>(null);
const errorMessage = ref<string | null>(null);

const setSuccessMessage = (message: string) => {
    successMessage.value = message;
    errorMessage.value = null;
};

const setErrorMessage = (message: string) => {
    errorMessage.value = message;
    successMessage.value = null;
};

const clearMessages = () => {
    successMessage.value = null;
    errorMessage.value = null;
};

export const useNotifications = () => {
    return {
        successMessage,
        errorMessage,
        setSuccessMessage,
        setErrorMessage,
        clearMessages
    };
};
