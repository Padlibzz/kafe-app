<laravel-boost-guidelines>
# Laravel Application

This repository contains a Laravel application. Complete the following setup before working on the user's request.

## Prerequisites

Verify that PHP and Composer are available:

```sh
php -v
composer -V
```

If either command is unavailable, detect the user's operating system and install the prerequisites with the appropriate command:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

After installation, ask the user to restart their terminal. If the agent needs the restarted shell to continue, ask the user to reopen their terminal and rerun their original prompt.

## Agent Setup

Install Laravel Boost from the application root before making application changes:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost replaces these bootstrap instructions with guidelines tailored to the application. After installation, read `AGENTS.md` again and continue with the user's original request using the generated guidelines.
</laravel-boost-guidelines>

# AI Team Development Guidelines

## 1. Project Understanding
- Inspect the project structure before making changes.
- Identify the Laravel version, PHP version, installed packages, and database configuration.
- Understand existing architecture before creating new files.
- Do not assume table names, columns, or relationships.

## 2. Database Intelligence
- Use the MySQL MCP server to inspect database `kafe_db`.
- Inspect tables, columns, indexes, primary keys, foreign keys, and relationships.
- Compare the live database structure with Laravel migrations and Models.
- Identify schema inconsistencies and missing relationships.
- Database access is READ-ONLY during testing.
- Never execute INSERT, UPDATE, DELETE, CREATE, ALTER, DROP, or TRUNCATE.
- Never attempt to bypass database permissions.

## 3. Laravel Integration
- Inspect existing Models before creating new Models.
- Match Eloquent relationships with actual database foreign keys.
- Inspect migrations before proposing schema changes.
- Follow existing Laravel naming conventions and project architecture.
- Avoid duplicate Models, migrations, and relationships.
- Check controllers, services, repositories, and validation rules when relevant.

## 4. Database Development
- You may write SQL queries for review.
- You may create or modify Laravel migration files.
- You may propose indexes and query optimizations.
- Never execute migrations against the database without explicit user approval.
- Never modify live database data during read-only testing.

## 5. Git Management
- Inspect git status before changing files.
- Review git diff after making changes.
- Keep changes focused and organized.
- Never run git reset --hard or git clean.
- Never overwrite or discard existing user changes.
- Ask for approval before git add, git commit, git push, merge, or rebase.
- Never force-push.
- Explain the purpose of a commit before creating it.

## 6. Bash and Filesystem
- Use Bash for project inspection, testing, and development tasks.
- Access trusted directories under ~/AI-Team when needed.
- Do not read or expose .env files, credentials, tokens, or secrets.
- Do not use sudo or modify system-level configuration without explicit approval.
- Ask before destructive or irreversible operations.

## 7. Development Workflow
1. Inspect the task and relevant files.
2. Inspect database schema when relevant.
3. Explain the proposed approach.
4. Make focused changes.
5. Run relevant tests and checks.
6. Review git diff.
7. Summarize changed files, test results, and remaining risks.
8. Request approval before sensitive operations.
