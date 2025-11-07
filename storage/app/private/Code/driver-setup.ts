/**
 * VueFinder Driver Setup Examples
 * 
 * This file demonstrates how to set up different drivers for VueFinder
 */

import { LocalDriver, RemoteDriver } from '@vuefinder/vuefinder'

// Example 1: Local Driver (Browser Storage)
export const localDriver = new LocalDriver({
  root: '/',
  showHiddenFiles: false
})

// Example 2: Remote Driver (API)
export const remoteDriver = new RemoteDriver({
  baseURL: 'https://api.example.com/files',
  headers: {
    'Authorization': 'Bearer YOUR_TOKEN_HERE',
    'Content-Type': 'application/json'
  },
  url: {
    list: '/list',
    search: '/search',
    upload: '/upload',
    delete: '/delete',
    rename: '/rename',
    createFile: '/create-file',
    createFolder: '/create-folder',
    move: '/move',
    copy: '/copy',
    preview: '/preview',
    download: '/download',
    save: '/save',
    archive: '/archive',
    unarchive: '/unarchive'
  }
})

// Example 3: Laravel Backend Driver
export const laravelDriver = new RemoteDriver({
  baseURL: '',
  headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
    'Accept': 'application/json'
  },
  url: {
    list: '/api/files',
    search: '/api/files/search',
    upload: '/api/files/upload',
    delete: '/api/files/delete',
    rename: '/api/files/rename',
    createFile: '/api/files/create-file',
    createFolder: '/api/files/create-folder',
    move: '/api/files/move',
    copy: '/api/files/copy',
    preview: '/api/files/preview',
    download: '/api/files/download',
    save: '/api/files/save',
    archive: '/api/files/archive',
    unarchive: '/api/files/unarchive'
  }
})

// Usage in component
// <vue-finder :driver="laravelDriver" :config="{ persist: true }" />




