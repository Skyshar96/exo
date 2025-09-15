# Repository-specific Copilot Instructions

This repository contains a small collection of PHP exercise scripts and a `POO/` folder with simple object-oriented examples. The guidance below helps an AI coding agent be productive quickly in this workspace.

Guiding principles
- Focus: these are standalone PHP scripts (learning/exercises), not a web app or framework project.
- Keep edits minimal and backwards-compatible: tests and CI are not present; prefer small, self-contained improvements.

Important files and layout
- Root PHP exercises: `ex1.php` … `ex9.php` — each file is a self-contained script demonstrating basic PHP features.
- `POO/` directory: `POO/ex1.php`, `POO/ex2.php` — simple classes demonstrating constructors, properties and methods.

Patterns and conventions discovered
- Imperative scripts: functions and procedural code at top-level; output via `echo` and `print_r`.
- Minimal OOP: classes are defined inline in scripts; no autoloading or namespaces are used.
- Type hints: occasional scalar type hints appear (e.g. `string`, `float`) but not consistently enforced across files.

What a helpful AI change looks like
- Fix small bugs and typos while preserving the original learning intent (e.g., syntax errors, mismatched quotes, assignment mistakes).
- Add short, in-file comments (1-2 lines) explaining non-obvious code choices or common pitfalls for learners.
- When refactoring, prefer localized changes: extract a function or correct a single class rather than converting the repo to use Composer/PSR-4.

Examples from this repo
- `ex2.php`: uses `max()` and `min()` on an array and prints values — keep output messages in French to match file tone.
- `POO/ex1.php`: class `Livre` has malformed string quotes and slightly inconsistent property initialization — fix quoting and constructor usage.
- `ex9.php`: demonstrates abstract class `Media` and subclasses — avoid changing the public API, but correct logic errors if present.

Developer workflows
- Execution: run a script with the command `php <file>` from the repo root (e.g., `php ex9.php`).
- Debugging: use `echo`, `var_dump()`, or run under XAMPP/WAMP (files are already placed in `www` for quick browser access).

When to ask the user before changing
- Converting the project to use a framework, Composer, or namespaces — ask before making large structural changes.
- Changing language/locale of output (French vs English) — preserve existing language unless user requests otherwise.

Do not modify
- Do not remove example scripts or rewrite them into a single application without explicit instruction.

If you need more context
- Ask where these exercises came from (course, tutorial) and whether improvements should remain pedagogical or production-ready.

Feedback
- If any section is unclear or you'd like additional examples (tests, README, minimal Composer setup), tell me what to add.
