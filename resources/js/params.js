const adminLinks = [
  {
    type: 'link',
    route: 'dashboard',
    title: 'dashboard',
    icon: 'speedometer',
  },
  {
    type: 'collapse',
    title: 'Manage users',
    collapsed: true,
    icon: 'users',
    pages: [
      {
        type: 'link',
        route: 'users.index',
        title: 'users',
      },
      {
        type: 'link',
        route: 'roles.index',
        title: 'roles',
      },
    ],
  },
  {
    type: 'collapse',
    title: 'Posts',
    collapsed: true,
    icon: 'write',
    pages: [
      {
        type: 'link',
        route: 'posts.index',
        title: 'posts',
        icon: 'write',
      },
    ],
  },
]

export default {
  adminLinks,
}
