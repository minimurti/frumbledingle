## The Original Problem
Frumbledingle Corp is struggling with its warehouse management, and has been looking for a developer to help. You need to create a small management app for their inventory. Part of this has been done for you by the last guy they hired - it's your job to finish it. This will consist of the following:


## The Solution
- This website has solved the requirments and also added a collection of new features. 

### Required fixes
- Components and Models were added to allow the creation of categories and items.
- A Report page has been made using a Query that will show the number of items with a price greater than an input price for each category and sub category

### Changes

- softDelete feature has been removed for the additional features listed below that improve integrity

### Additions
- The migration files have been adjusted so that:
    - deletion of a location will delete all items that belong to that location
    - deletion of a category will delete all items that belong to that category
    - deletion of a catagory will also delete all of its children that belong to that category

### Potential Updates

- Improve the overall styling of the page
- Include in the Report Page that shows the count of a parent category based on the sum of the items in it's child categories
    - (This was not done so as to ensure the Report Table Matches the Example Table)

## How to Run
- Clone the repository
- Run the following commands in the project directory
    - composer install
        - (check your .env file)
    - php artisan migrate
        - (due to removing softDelete, you may also need to run migrate:refresh)
    - npm run dev
    - php artisan serve


- Go to the url show in the next line after running the last php command which should say something like:
    - Laravel development server started: <http://127.0.0.1:8000>



