# Contributing to This Repository

Welcome! This guide explains how to contribute using our **simplified Git Flow** approach.

## 📋 Table of Contents

- [Branch Overview](#branch-overview)
- [Branch Naming Conventions](#branch-naming-conventions)
- [Workflow](#workflow)
- [Pull Request Process](#pull-request-process)
- [Quick Reference](#quick-reference)

---

## 🌳 Branch Overview

| Branch | Purpose | Deploys To |
|--------|---------|------------|
| `trunk` | Production-ready code (primary branch, source for all new branches) | **Production** |
| `staging` | Integration branch for testing | **Staging Environment** |

> ⛔ **IMPORTANT: `staging` is NEVER merged into `trunk`**
>
> The `staging` branch is only used for testing purposes. When changes are approved, the **original working branch** is merged directly into `trunk`. This keeps our production branch clean and ensures we have full traceability of individual changes.

### Flow Summary

```
     ┌─────────┐
     │  trunk  │ ◄─── Source for ALL new branches
     └────┬────┘
          │
          │ (branch created from trunk)
          ▼
   ┌──────────────┐
   │ feature/     │
   │ bugfix/      │
   │ hotfix/      │
   └──────┬───────┘
          │
          ├────────────────┐
          │                │
          ▼ (direct merge) │
     ┌─────────┐           │
     │ staging │           │
     └────┬────┘           │
          │                │
          ▼                │
   ┌─────────────┐         │
   │   Staging   │         │
   │ Environment │         │
   │ (QA Testing)│         │
   └─────────────┘         │
          │                │
          │ Approved       │
          │                │
          ▼                ▼ (Pull Request)
     ┌─────────┐     ┌─────────┐
     │    ✗    │     │  trunk  │ ───► Production
     │ staging │     └─────────┘
     │ is NOT  │
     │ merged  │
     └─────────┘
```

---

> 🚨 **NEVER MERGE `staging` INTO `trunk`**
>
> The `staging` branch may contain multiple features being tested simultaneously and could include work that is not yet approved. Always merge the original working branch directly into `trunk`.

---

## 📝 Branch Naming Conventions

Use the following prefixes for your branches:

| Type | Pattern | Example | Use Case |
|------|---------|---------|----------|
| Feature | `feature/short-description` | `feature/user-authentication` | New functionality |
| Bug Fix | `bugfix/short-description` | `bugfix/login-validation` | Non-urgent fixes |
| Hotfix | `hotfix/short-description` | `hotfix/critical-security-patch` | Urgent production fixes |

**Guidelines:**
- Use lowercase letters
- Use hyphens (`-`) to separate words
- Keep names short but descriptive
- Include ticket/issue number if applicable (e.g., `feature/123-user-auth`)

---

## 🔄 Workflow

The workflow is identical for all branch types. **The only difference is the branch name prefix** (`feature/`, `bugfix/`, or `hotfix/`).

### Step-by-Step Process

#### 1. Create Your Branch from Trunk

```bash
git checkout trunk
git pull origin trunk
git checkout -b <type>/your-branch-name
```

Replace `<type>` with `feature`, `bugfix`, or `hotfix` depending on your work.

#### 2. Make Your Changes

```bash
# Make changes to your code
git add .
git commit -m "feat: add user login functionality"
```

#### 3. Keep Your Branch Updated

```bash
git fetch origin
git rebase origin/trunk
```

#### 4. Merge Directly into Staging (No PR Required)

```bash
git checkout staging
git pull origin staging
git merge <type>/your-branch-name
git push origin staging
```

This deploys your changes to the **Staging Environment** for testing.

#### 5. Wait for QA Approval

Your changes will be tested in the staging environment.

#### 6. Open a Pull Request → `trunk`

- After approval, create a Pull Request from your branch **directly** to `trunk`
- Do **NOT** merge staging into trunk
- Once merged, your changes deploy to **Production**

### Visual Flow

```
<type>/your-branch-name
         │
         ├────► staging (direct merge, no PR)
         │           │
         │           ▼
         │      Staging Environment
         │           │
         │       QA Approval
         │           │
         │           ▼
         └────► trunk (Pull Request required)
                     │
                     ▼
              Production Environment
```

---

## 🔍 Pull Request Process

> 📝 **Note:** Pull Requests are only required when merging to `trunk`. You can merge directly to `staging` without a PR.

### Before Submitting a PR to Trunk

- [ ] Code has been tested in the staging environment
- [ ] QA has approved the changes
- [ ] Code follows project style guidelines
- [ ] All tests pass locally
- [ ] Branch is up to date with `trunk`
- [ ] Commit messages are clear and descriptive
- [ ] Documentation is updated (if applicable)

### PR Requirements

1. **Title:** Use a clear, descriptive title
2. **Description:** Explain what changes were made and why
3. **Reviewers:** Request at least one reviewer
4. **Labels:** Add appropriate labels (feature, bugfix, etc.)

### Merge Strategy

| Target Branch | Method | PR Required |
|---------------|--------|-------------|
| `staging` | Direct merge | ❌ No |
| `trunk` | Merge commit | ✅ Yes |

### Release Process

```
┌──────────────────────────────────────────────────────────────────┐
│                         RELEASE FLOW                             │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│   1. Create branch from trunk                                    │
│      trunk ─────► <type>/your-branch                             │
│                                                                  │
│   2. Merge directly to staging (no PR required)                  │
│      <type>/your-branch ─────► staging ─────► Staging Env        │
│                                                                  │
│   3. QA Testing & Approval                                       │
│                                                                  │
│   4. Open PR directly to trunk (NOT from staging!)               │
│      <type>/your-branch ─────► trunk ─────► Production Env       │
│                           ▲                                      │
│                           │                                      │
│                           └─── Direct merge from working branch  │
│                                                                  │
│   ⛔ staging ───✗───► trunk (NEVER DO THIS)                      │
│                                                                  │
└──────────────────────────────────────────────────────────────────┘
```

---

## ⚡ Quick Reference

```bash
# Start any new work (always from trunk)
git checkout trunk && git pull
git checkout -b <type>/description   # feature/, bugfix/, or hotfix/

# Make your changes and commit
git add .
git commit -m "feat: description of change"

# Update your branch with latest trunk
git fetch origin
git rebase origin/trunk

# Merge to staging for testing (no PR needed)
git checkout staging
git pull origin staging
git merge <type>/description
git push origin staging

# After QA approval, create PR from your branch to trunk
# (Do this via GitHub/GitLab UI)
```

### Branch Rules Summary

| Rule | Description |
|------|-------------|
| **Create from** | Always create branches from `trunk` |
| **Staging merge** | Direct merge (no PR required) |
| **Trunk merge** | Pull Request required |
| **Never** | Never merge `staging` into `trunk` |
| **Never** | Never create branches from `staging` |

---

## ⛔ What NOT To Do

| Action | Why It's Wrong |
|--------|----------------|
| Merge `staging` into `trunk` | `staging` may contain untested or unapproved code |
| Create branches from `staging` | `staging` is not the source of truth |
| Skip testing in `staging` | Changes must be tested before production |
| Merge to `trunk` before QA approval | Untested code could reach production |
| Open a PR to `staging` | Direct merges are preferred for staging |

---

## 📌 Commit Message Format

We follow [Conventional Commits](https://www.conventionalcommits.org/):

```
<type>: <short description>

[optional body]

[optional footer]
```

**Types:**
- `feat:` - New feature
- `fix:` - Bug fix
- `docs:` - Documentation changes
- `style:` - Code style changes (formatting, etc.)
- `refactor:` - Code refactoring
- `test:` - Adding or updating tests
- `chore:` - Maintenance tasks

**Examples:**
```bash
feat: add user registration endpoint
fix: resolve null pointer in auth service
docs: update API documentation
```

---

## ❓ Questions?

If you have any questions about the contribution process, please:
- Open an issue with the `question` label
- Reach out to the maintainers

**Happy Contributing!** 🎉
