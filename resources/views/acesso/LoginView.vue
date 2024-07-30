<script setup lang="ts">
import axios from 'axios';
import LoginForm from '../../components/acesso/LoginForm.vue';
import { LoginData, LoginResponse } from '../../types/auth';
import { useNotifications } from '../../components/notification/index';
import { useRouter } from 'vue-router';

const router = useRouter();

const { setSuccessMessage, setErrorMessage } = useNotifications();

const handleLogin = async (data: LoginData) => {
    try {
        const response = await axios.post<LoginResponse>('/api/autenticar', data);
        setSuccessMessage('Login realizado com sucesso!');
        router.push('/inicio');
    } catch (error) {
        setErrorMessage('Falha no login. Verifique as credenciais e tente novamente!');
    }
};
</script>

<template>
    <div>
        <LoginForm @login="handleLogin" />
    </div>
</template>
