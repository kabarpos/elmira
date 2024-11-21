const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"admin.dashboard":{"uri":"admin","methods":["GET","HEAD"]},"admin.users.index":{"uri":"admin\/users","methods":["GET","HEAD"]},"admin.users.create":{"uri":"admin\/users\/create","methods":["GET","HEAD"]},"admin.users.store":{"uri":"admin\/users","methods":["POST"]},"admin.users.show":{"uri":"admin\/users\/{user}","methods":["GET","HEAD"],"parameters":["user"]},"admin.users.edit":{"uri":"admin\/users\/{user}\/edit","methods":["GET","HEAD"],"parameters":["user"]},"admin.users.update":{"uri":"admin\/users\/{user}","methods":["PUT","PATCH"],"parameters":["user"]},"admin.users.destroy":{"uri":"admin\/users\/{user}","methods":["DELETE"],"parameters":["user"]},"admin.roles.index":{"uri":"admin\/roles","methods":["GET","HEAD"]},"admin.roles.create":{"uri":"admin\/roles\/create","methods":["GET","HEAD"]},"admin.roles.store":{"uri":"admin\/roles","methods":["POST"]},"admin.roles.show":{"uri":"admin\/roles\/{role}","methods":["GET","HEAD"],"parameters":["role"]},"admin.roles.edit":{"uri":"admin\/roles\/{role}\/edit","methods":["GET","HEAD"],"parameters":["role"]},"admin.roles.update":{"uri":"admin\/roles\/{role}","methods":["PUT","PATCH"],"parameters":["role"]},"admin.roles.destroy":{"uri":"admin\/roles\/{role}","methods":["DELETE"],"parameters":["role"]},"admin.posts.index":{"uri":"admin\/posts","methods":["GET","HEAD"]},"admin.posts.create":{"uri":"admin\/posts\/create","methods":["GET","HEAD"]},"admin.posts.store":{"uri":"admin\/posts","methods":["POST"]},"admin.posts.show":{"uri":"admin\/posts\/{post}","methods":["GET","HEAD"],"parameters":["post"]},"admin.posts.edit":{"uri":"admin\/posts\/{post}\/edit","methods":["GET","HEAD"],"parameters":["post"]},"admin.posts.update":{"uri":"admin\/posts\/{post}","methods":["PUT","PATCH"],"parameters":["post"]},"admin.posts.destroy":{"uri":"admin\/posts\/{post}","methods":["DELETE"],"parameters":["post"]},"admin.categories.index":{"uri":"admin\/categories","methods":["GET","HEAD"]},"admin.categories.create":{"uri":"admin\/categories\/create","methods":["GET","HEAD"]},"admin.categories.store":{"uri":"admin\/categories","methods":["POST"]},"admin.categories.show":{"uri":"admin\/categories\/{category}","methods":["GET","HEAD"],"parameters":["category"]},"admin.categories.edit":{"uri":"admin\/categories\/{category}\/edit","methods":["GET","HEAD"],"parameters":["category"]},"admin.categories.update":{"uri":"admin\/categories\/{category}","methods":["PUT","PATCH"],"parameters":["category"]},"admin.categories.destroy":{"uri":"admin\/categories\/{category}","methods":["DELETE"],"parameters":["category"]},"admin.media.index":{"uri":"admin\/media","methods":["GET","HEAD"]},"admin.media.create":{"uri":"admin\/media\/create","methods":["GET","HEAD"]},"admin.media.store":{"uri":"admin\/media","methods":["POST"]},"admin.media.show":{"uri":"admin\/media\/{medium}","methods":["GET","HEAD"],"parameters":["medium"]},"admin.media.edit":{"uri":"admin\/media\/{medium}\/edit","methods":["GET","HEAD"],"parameters":["medium"]},"admin.media.update":{"uri":"admin\/media\/{medium}","methods":["PUT","PATCH"],"parameters":["medium"]},"admin.media.destroy":{"uri":"admin\/media\/{medium}","methods":["DELETE"],"parameters":["medium"]},"profile.edit":{"uri":"profile","methods":["GET","HEAD"]},"profile.update":{"uri":"profile","methods":["PATCH"]},"profile.destroy":{"uri":"profile","methods":["DELETE"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };