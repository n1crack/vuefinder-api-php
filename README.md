# VueFinder API

A Laravel-based REST API for VueFinder file management operations.

## Description

This project provides a backend API for VueFinder, a file manager library. It enables file and folder operations including listing, searching, uploading, downloading, renaming, moving, copying, archiving, and more.

## Requirements

- PHP >= 8.2
- Composer

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd vuefinder-api-php
```

2. Install dependencies:
```bash
composer install
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure storage:
```bash
php artisan storage:link
```

5. Run migrations (if needed):
```bash
php artisan migrate
```

## Quick Start

Start development server:
```bash
composer run dev
```

## API Endpoints

All endpoints are prefixed with `/api/files`:

### GET Endpoints
- `GET /api/files` - List files in a directory
- `GET /api/files/search` - Search files
- `GET /api/files/download` - Download a file
- `GET /api/files/preview` - Preview a file

### POST Endpoints
- `POST /api/files/upload` - Upload a file
- `POST /api/files/rename` - Rename a file/folder
- `POST /api/files/move` - Move files/folders
- `POST /api/files/copy` - Copy files/folders
- `POST /api/files/archive` - Archive files/folders
- `POST /api/files/unarchive` - Extract archive
- `POST /api/files/create-file` - Create a new file
- `POST /api/files/create-folder` - Create a new folder
- `POST /api/files/save` - Save file content
- `POST /api/files/delete` - Delete files/folders

## Storage Configuration

The API uses three storage disks configured in `VueFinderServiceProvider`:

- `local://` - Maps to `storage/app/private`
- `public://` - Maps to `storage/app/public`
- `media://` - Maps to `storage/app/public/media` (with public URL access)

## Usage Example

```bash
# List files in a directory
GET /api/files?path=local://uploads

# Upload a file
POST /api/files/upload?path=local://uploads
Content-Type: multipart/form-data
Body: file=<file>

# Delete a file
DELETE /api/files/delete?path=local://uploads/file.txt
```

## License

MIT

