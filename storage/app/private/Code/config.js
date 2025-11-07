// VueFinder Configuration Example
export const vuefinderConfig = {
  // Theme settings
  theme: {
    mode: 'light', // 'light' | 'dark' | 'auto'
    primaryColor: '#3b82f6',
    accentColor: '#8b5cf6'
  },

  // View settings
  view: {
    default: 'grid', // 'grid' | 'list'
    showThumbnails: true,
    thumbnailSize: 'medium' // 'small' | 'medium' | 'large'
  },

  // File operations
  operations: {
    allowUpload: true,
    allowDownload: true,
    allowDelete: true,
    allowRename: true,
    allowMove: true,
    allowCopy: true,
    allowCreateFolder: true,
    maxFileSize: 10485760, // 10MB in bytes
    allowedFileTypes: ['image/*', 'application/pdf', 'text/*']
  },

  // Features
  features: {
    search: true,
    preview: true,
    dragDrop: true,
    keyboardShortcuts: true,
    persistence: true
  },

  // Customization
  customization: {
    showBreadcrumbs: true,
    showToolbar: true,
    showSidebar: true,
    customActions: []
  }
}




