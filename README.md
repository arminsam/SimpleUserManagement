# SimpleUserManagement
A simple user management module to demonstrate using of Commands, Events, Decorators, Repositories, and Presenters as the building blocks of my application development framework.

# Design Overview
This mini application follows a powerful design that consists of various elements. Each element has a single responsibility and can be conbined with other elements to build a certain functionality in the system. Following is the list of elements with brief description about their purpose and role in the overall design.

##1. Commands
Commands are simple Data Transfer Objects (DTO) that encapsulate the data required for handling specific system-wide actions. For instance, registering a new user can be a considered as a command named "RegisterNewCommand" that contains `name`, `username`, and `password` as its attributes.

##2. Command Handlers
As their name implies, command handlers are classes that handle the execution of their corresponding commands. This class implements `CommandHandler` interface that requires a `handle` method to be implemented. Usually, the command handler will delegate the task to appropriate Model for any CRUD operation to be done.

##3. Command Bus
A service class that maps each Command to its corresponding CommandHandler. This mapping is done by following the convention below:

- Name your command class with the word `Command` appended to it, e.g. RegisterNewUserCommand
- Name the handler classe for this command ending with `CommandHandler`, e.g. RegisterNewUserCommandHandler

##4. Decorators
Decorators are classes that define additional actions to be taken before a command being executed. A good use case of decorators is when Validation, Authorization, or Sanitization actions are needed before a command is executed.

##5. Events
Events are also simple DTOs that are raised after a command is successfully executed. For instance, `NewUserHasRegistered` is an event that will be raised whenever a new user is registered. It is possible to raise multiple events related to different actions and dispatch them all together once the command execution is finished. You can listen to events anywhere in your application in order to do post-execuation actions, e.g. sending out emails.

##6. Repositories
Repositories are interfaces that define a contract for dealing with persistant data. This enables the application to work well with any database/ORM as long as a concrete implementation of the contract is provided. For instance, you can have one implementation that returns Eloquent collections, and another implementation that returns json objects to be used as API response.

##7. View Presenters
View presenters are classes that contains methods for displaying complicated view elements. They are assigned to Models and are accessible within your Views by calling `->present()` method, e.g. `$user->present()->fullName`.

# Application Lifecycle
Using the design elements above as building blocks of your application, you can build highly complex systems that are scalable and highly maintainable. However, it is crucial to know when and where to use each of these elements in your code. The following steps go through the lifecycle of a request from the time it is received by the routes file until it is responded by the controller:

1. The route file checks the request, applies filters to it, and calls a controller action on it
2. The controller receives the request, gathers the data required for handling the request from the repository, and execute a command based on those data
3. If there are any decorators specified by the controller to accompany the command execution, the command bus will execute them first based on the order they are defined
4. After successful execution of decorators, the command will be dispatched to its corresponding handler by the command bus
5. Command handler receives the command data and process them by delegating CRUD tasks to the Model and/or executing other command if required
6. Model will do the CRUD related task and raise specific events that will be dispatch later by the command handler
7. Event handlers get notified of the raised events and perform certain actions
8. Controller gets back the result from command execution and loads a view based on that result
