# How should the new Backend function?

## Concept 1
Admin will be integrated as a Role selector in Member list, all Committees need to register as a Member by default.
- AuthController (Validates the User Role)
    - Middleware (That evaluates their Role)
        - Redirect to their respected Dashboard seamlessly
            - /my-profile (Members)
            - /dashboard (Admin/SuperAdmin)
            - CAS Authentication needed for linking their User Account to get their latest profile details. 
            - ST will be saved on UserStorage Model so we don't need to always query for new ST on every refresh. (Unless ST expired).


## Concept 2 
The Separate Account Theory.
- AuthController (All Separate Account)
    - Separate Middleware for each Role specific, Member, User (Admin/SuperAdmin)
        - /my-profile (Members),
        - /dashboard (Remains as the same for Admin/SuperAdmin)
        - CAS Authentication needed for linking their User Account to get their latest profile details.
        - ST will be saved on UserStorage Model so we don't need to always query for new ST on every refresh. (Unless ST expired).
