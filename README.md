### Description
This is a (modified) excerpt from a multiple production projects.

Please note that the files in this repo are examples compiled from an actual projects. The files have had portions removed, or ported over from other files in order to provide as complete an example as possible. They are not intended to work as-is. In a real project, some of these components would be broken into multiple smaller components--they have been merged to one file for example purposes :)

### High-level Project Description
The projects these files are extracted from have several goals (this is a combined list, not separate by project) :
- migrate content from an existing REST API-powered CMS to WordPress
- maintain the same REST API structure as other applications make use of the API
- frontend allows on-page editing of content, forcing plain text--no formatting is allowed
- wp-admin page/post Edit screens allow internationalization, SEO meta entry and content entry
- one project is a hybrid SPA with statically generated pages, another was a site that is statically generated using client-managed content entered in WordPress

### Pain points
- client does not currently have a GUI for quick content entry, aside from existing on-page editing of existing site
- current CMS is very simple, and thus does not have import/export, bulk editing, etc that are either natively part of or can be added to WordPress

### The Files
`vue/components/admin/EditableContent.vue`
- this is the custom Vue component used to render parts of the page that are editable
- if the user is has sufficient permissions to edit the content (ie: they are logged in with a privileged user), the fields are plain-text editable
- if user does not have sufficient privileges, the content is rendered as ordinary HTML tags
- when the content has been edited, the component emits an `edit` event, which allows the parent components to handle the changes (to save or temporarily store them, for example)
- when the edit event is emitted, it emits `undefined` if the value is the same as its original value, and the current value if it has been changed
- if the `field` provided is an object (dot notation, such as `hero.title`), an object `{ hero: { title: 'value goes here' } }` is the emitted value

`vue/views/editor.vue`
- stripped-down example of the homepage (child section components moved into this file for ease of viewing)
- makes use of the `ContentHandler` (not included) mixin, which handles pulling content from the WordPress wp-json API, as well as formatting it internally as easy-to-read computed values such as `heroTitle`
- `ContentHandler` also handles parsing of meta data as it is also received from WordPress
- the `EditablePage` mixin (also not included) handles all values emitted from `<editable-content` components, as well as pushing new values back to the WP API
- `asyncData` is used to fetch the page's data. this is called when the page is rendered on-server for initial load, upon navigation via `vue-router`, or when the page is pre-rendered as a flat HTML file during deployment
- `head` sets page `<title` and SEO meta tags, which are also rendered on-server or updated dynamically when navigating via `vue-router`

`vue/views/index.vue`
- stripped-down example of one of the homepages (child section components moved into this file for ease of viewing)
- this version supports multiple languages, and content is managed through `<i18n>` yaml syntax at the top of the file
- the site this file is based on is a statically generated high-performance site with no CMS

`wordpress/admin/admin-screenshot.png`
- screenshot of how the WordPress admin is set up for content entry
- content sections on the Edit page are laid out to match the layout on the rendered page on the frontend for easy of entry by the client

`wordpress/plugins/content-api.php`
- **very** stripped down basic snippet from the custom plugin that was developed to create a namespaced wp-json endpoint which returns content data objects in the same structure as the original CMS
- this example is only a very basic example. the actual functional plugin is much more complex and thus object-oriented, not functional
