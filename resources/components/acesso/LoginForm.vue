<script setup>
import { ref, reactive, defineEmits} from 'vue';
import { loginSchema } from './validation/LoginSchema';

const emit = defineEmits(['login'])
const email = ref('');
const password = ref('');
const visible = ref(false);
const errors = reactive({
  email: '',
  password: '',
});

const validateForm = async () => {
  try {
    await loginSchema.validate(
      { email: email.value, password: password.value },
      { abortEarly: false }
    );
    errors.email = '';
    errors.password = '';
    submitForm();
  } catch (err) {
    if (err.inner) {
      err.inner.forEach((validationError) => {
        errors[validationError.path] = validationError.message;
      });
    }
  }
};

const submitForm = () => {
    emit('login', {
        email: email.value,
        senha: password.value,
    });
};
</script>

<template>
  <v-form @submit.prevent="validateForm">
    <div>
      <v-img
        class="mx-auto my-6"
        max-width="228"
        src="https://cdn.vuetifyjs.com/docs/images/logos/vuetify-logo-v3-slim-text-light.svg"
      ></v-img>

      <v-card class="mx-auto pa-12 pb-8" elevation="8" max-width="448" rounded="lg">
        <div class="text-subtitle-1 text-medium-emphasis">Login</div>

        <v-text-field
          v-model="email"
          :error-messages="errors.email"
          density="compact"
          placeholder="Endereço de Email"
          prepend-inner-icon="mdi-email-outline"
          variant="outlined"
        ></v-text-field>

        <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
          Senha
          <a
            class="text-caption text-decoration-none text-blue"
            href="#"
            rel="noopener noreferrer"
            target="_blank"
          >
            Esqueceu sua senha?
          </a>
        </div>

        <v-text-field
          v-model="password"
          :error-messages="errors.password"
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Coloque sua senha"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          @click:append-inner="visible = !visible"
        ></v-text-field>

        <v-card class="mb-12" color="surface-variant" variant="tonal">
          <v-card-text class="text-medium-emphasis text-caption">
            Aviso: Após 3 tentativas consecutivas de login sem sucesso, sua conta será temporariamente bloqueada por três horas. Se você precisa fazer login agora, você também pode clicar em "Esqueceu a senha de login?" abaixo para redefinir a senha de login.
          </v-card-text>
        </v-card>

        <v-btn type="submit" class="mb-8" color="blue" size="large" variant="tonal" block>
          Entrar
        </v-btn>

        <v-card-text class="text-center">
          <a
            class="text-blue text-decoration-none"
            href="#"
            rel="noopener noreferrer"
            target="_blank"
          >
            Registre-se agora <v-icon icon="mdi-chevron-right"></v-icon>
          </a>
        </v-card-text>
      </v-card>
    </div>
  </v-form>
</template>
