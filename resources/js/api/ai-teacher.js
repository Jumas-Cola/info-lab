class AiTeacherApi {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  async send(message) {
    return axios.post(this.baseUrl, {
      message: message,
    });
  }
}

export default AiTeacherApi;
