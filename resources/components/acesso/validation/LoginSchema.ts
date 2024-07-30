import * as yup from 'yup';
import { defineRule, configure } from 'vee-validate';
import { required, email, min } from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';

const loginSchema = yup.object({
  email: yup
    .string()
    .required('Campo obrigatório')
    .email('E-mail inválido.'),
  password: yup
    .string()
    .required('Campo obrigatório')
    .min(6, 'Senha deve ter no mínimo 6 caracteres.'),
});

defineRule('required', required);
defineRule('email', email);
defineRule('min', min);

configure({
  validateOnInput: true,
  validateOnBlur: true,
  validateOnChange: true,
  validateOnModelUpdate: true,
  generateMessage: localize({
    en: {
      messages: {
        required: 'Campo obrigatório',
        email: 'E-mail inválido',
        min: `Senha deve ter no mínimo 6 caracteres`,
      },
    },
  }),
});

export { loginSchema };
