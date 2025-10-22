# Theme Setup Guide

## Quick Start

### 1. Include Theme Files
Add these lines to your base layout (`resources/views/layouts/app.blade.php`):

```html
<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme-utilities.css') }}">

<!-- Icons (Lucide Icons) -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
```

### 2. Initialize Icons
Add this script before closing `</body>` tag:

```html
<script>
    lucide.createIcons();
</script>
```

### 3. Basic Page Structure
```html
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i data-lucide="icon-name"></i>
                    Card Title
                </h3>
            </div>
            <div class="card-body">
                <!-- Your content here -->
            </div>
        </div>
    </div>
</div>
@endsection
```

## Component Examples

### Alert Messages
```html
<div class="alert alert-success">
    <i data-lucide="check-circle"></i>
    Success message here
</div>
```

### Form with Validation
```html
<form method="POST" action="{{ route('example.store') }}">
    @csrf
    <div class="form-group">
        <label for="name" class="form-label">
            <i data-lucide="user"></i>
            Name
        </label>
        <input 
            type="text" 
            id="name"
            name="name" 
            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            value="{{ old('name') }}"
            required
        >
        @if($errors->has('name'))
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
    </div>
    
    <button type="submit" class="btn btn-primary">
        <i data-lucide="save"></i>
        Save
    </button>
</form>
```

### Data Table
```html
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <i data-lucide="hash"></i>
                    ID
                </th>
                <th>
                    <i data-lucide="user"></i>
                    Name
                </th>
                <th>
                    <i data-lucide="settings"></i>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-outline">
                            <i data-lucide="edit"></i>
                        </a>
                        <a href="{{ route('item.delete', $item->id) }}" class="btn btn-sm btn-danger">
                            <i data-lucide="trash-2"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
```

### Badge Usage
```html
<span class="badge badge-primary">Active</span>
<span class="badge badge-success">Completed</span>
<span class="badge badge-warning">Pending</span>
<span class="badge badge-danger">Failed</span>
```

## Common Icons
- `user` - User profiles
- `users` - Multiple users
- `home` - Dashboard/Home
- `settings` - Configuration
- `edit` - Edit actions
- `trash-2` - Delete actions
- `plus` - Add/Create
- `save` - Save actions
- `x` - Close/Cancel
- `check` - Confirm/Success
- `alert-circle` - Warnings
- `info` - Information
- `calendar` - Dates/Schedule
- `book-open` - Education/Subjects
- `graduation-cap` - School/Education
- `shield-check` - Security/Admin
- `log-in` - Login
- `log-out` - Logout
- `arrow-left` - Back navigation
- `arrow-right` - Forward navigation

## Responsive Classes
- `col-12` - Full width
- `col-6` - Half width
- `col-4` - One third width
- `col-3` - One quarter width

## Utility Classes
- `text-center` - Center align text
- `text-right` - Right align text
- `text-muted` - Muted text color
- `text-primary` - Primary color text
- `mb-4` - Margin bottom
- `mt-4` - Margin top
- `p-4` - Padding all sides
- `d-flex` - Flexbox display
- `gap-3` - Flex gap
- `justify-content-center` - Center justify
- `align-items-center` - Center align

## Animation Classes
- `fade-in` - Fade in animation
- `slide-up` - Slide up animation

## Testing the Theme
1. Visit `/login` - Should show modern login form
2. Visit `/register` - Should show registration form with role selection
3. Login and visit `/home` - Should show dashboard with cards
4. Visit `/siswa/create` - Should show modern form layout

## Troubleshooting

### Icons not showing
- Check if Lucide script is loaded
- Ensure `lucide.createIcons()` is called after DOM load

### Styles not applying
- Verify CSS files are in `public/css/` directory
- Check browser console for 404 errors
- Clear browser cache

### Layout issues on mobile
- Test responsive breakpoints
- Check viewport meta tag is present

## Browser Support
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## Performance Tips
- Use CDN for Lucide icons in production
- Consider minifying CSS files
- Enable gzip compression on server
- Use browser caching headers

## Customization
To customize colors, modify CSS variables in `theme.css`:

```css
:root {
  --primary-600: #your-color;
  --success: #your-success-color;
  /* etc... */
}
```
