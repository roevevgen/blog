## Installation

**Clone the repo**

```bash
git clone https://github.com/roevevgen/blog.git
```
**Switch into the newly created repo folder**

```bash
cd blog
```
**Create the `.env` file**

```bash
cp .env.example .env
```
**Install the dependencies**

```bash
composer install
npm install
```

**Generate encryption key**

```bash
php artisan key:generate
```
**Run the migrations**

```bash
php artisan migrate
```

**Seed the database**

```bash
php artisan migrate:fresh --seed
```

**Start**
```bash
php artisan serve
```
