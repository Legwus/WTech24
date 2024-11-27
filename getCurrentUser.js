const users = [
  {
    username: "tom",
    token:
      "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNjMwMjgyfQ.R4fqhDBoT011itGxilKlo2JTK0Dj69ugs8YiJoR_DqI",
    isActive: true,
  },
  {
    username: "jerry",
    token:
      "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzI2MzAyODJ9.pA9-AuP-DEuuRcYOf6Xv9oD8O3AqiFwjLh239oIJACI",
    isActive: false,
  },
];

const getCurrentUser = () => {
  return users.find((user) => user.isActive);
};
