class AiTeacherApi {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
    this.contextLength = 6;
  }

  async send(messages) {
    return axios.post(this.baseUrl, {
      messages: messages.slice(this.contextLength * -1),
    });
  }
}

export default AiTeacherApi;
