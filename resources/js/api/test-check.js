class TestCheckApi {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  async checkAnswers(testId, answers) {
    return axios
      .post(this.baseUrl, {
        test_id: testId,
        answers: answers,
      });
  }
}

export default TestCheckApi;
