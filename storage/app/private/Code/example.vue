<template>
  <div class="vuefinder-demo">
    <vue-finder
      :driver="driver"
      :config="config"
      @file-selected="handleFileSelect"
      @folder-changed="handleFolderChange"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RemoteDriver } from '@vuefinder/vuefinder'

const driver = new RemoteDriver({
  baseURL: '/api/files',
  headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('token')
  }
})

const config = ref({
  theme: 'light',
  view: 'grid',
  showHiddenFiles: false,
  maxFileSize: 10485760 // 10MB
})

const handleFileSelect = (file) => {
  console.log('File selected:', file)
}

const handleFolderChange = (folder) => {
  console.log('Folder changed:', folder)
}
</script>

<style scoped>
.vuefinder-demo {
  padding: 20px;
  background: #f5f5f5;
  border-radius: 8px;
}
</style>




