<template>
    <div class="notification-container">
      <v-alert
        v-if="successMessage"
        type="success"
        prominent
        class="notification-card"
      >
        {{ successMessage }}
      </v-alert>
      <v-alert
        v-if="errorMessage"
        type="error"
        prominent
        class="notification-card"
      >
        {{ errorMessage }}
      </v-alert>
    </div>
  </template>

  <script setup lang="ts">
  import { useNotifications } from './notification/index';

  const { successMessage, errorMessage } = useNotifications();
  </script>

  <style scoped>
  .notification-container {
    position: fixed;
    top: 0px;
    right: 0px;
    width: 400px;
    z-index: 1000;
  }
  </style>
